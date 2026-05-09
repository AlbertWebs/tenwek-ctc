<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TwoFactorCode;
use App\Models\User;
use App\Models\SiteSetting;
use App\Notifications\AdminTwoFactorCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private const TWO_FACTOR_SESSION_KEY = 'admin_2fa_user_id';
    private const TWO_FACTOR_CHANNELS_SESSION_KEY = 'admin_2fa_channels';

    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin-dashboard.index');
        }
        return view('admin-dashboard.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('These credentials do not match our records.'),
            ]);
        }

        $request->session()->regenerate();

        if (! Auth::user()->isAdmin()) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => __('You do not have access to the admin dashboard.'),
            ]);
        }

        $user = Auth::user();

        $channels = $this->enabledTwoFactorChannelsForUser($user);
        if (count($channels) === 0) {
            return redirect()->intended(route('admin-dashboard.index'));
        }

        // Step 1 ok → require step 2 for admin dashboard
        $this->sendTwoFactorCode($user, $channels);
        $request->session()->put(self::TWO_FACTOR_SESSION_KEY, $user->id);
        $request->session()->put(self::TWO_FACTOR_CHANNELS_SESSION_KEY, $channels);

        Auth::logout();

        return redirect()->route('admin-dashboard.two-factor');
    }

    public function showTwoFactorForm(Request $request)
    {
        $userId = $request->session()->get(self::TWO_FACTOR_SESSION_KEY);
        if (! $userId) {
            return redirect()->route('admin-dashboard.login');
        }

        $user = User::query()->find($userId);
        if (! $user) {
            $request->session()->forget(self::TWO_FACTOR_SESSION_KEY);
            return redirect()->route('admin-dashboard.login');
        }

        return view('admin-dashboard.two-factor', [
            'email' => $user->email,
            'channels' => $request->session()->get(self::TWO_FACTOR_CHANNELS_SESSION_KEY, ['mail']),
        ]);
    }

    public function verifyTwoFactor(Request $request)
    {
        $userId = $request->session()->get(self::TWO_FACTOR_SESSION_KEY);
        if (! $userId) {
            return redirect()->route('admin-dashboard.login');
        }

        $data = $request->validate([
            'code' => ['required', 'string', 'min:6', 'max:6'],
        ]);

        $user = User::query()->find($userId);
        if (! $user) {
            $request->session()->forget(self::TWO_FACTOR_SESSION_KEY);
            return redirect()->route('admin-dashboard.login');
        }

        /** @var TwoFactorCode|null $record */
        $record = TwoFactorCode::query()
            ->where('user_id', $user->id)
            ->whereNull('consumed_at')
            ->orderByDesc('id')
            ->first();

        if (! $record || now()->greaterThan($record->expires_at)) {
            throw ValidationException::withMessages([
                'code' => 'The verification code has expired. Please request a new code.',
            ]);
        }

        if ($record->attempts >= 6) {
            throw ValidationException::withMessages([
                'code' => 'Too many attempts. Please request a new code.',
            ]);
        }

        $record->attempts++;
        $record->save();

        if (! Hash::check($data['code'], $record->code_hash)) {
            throw ValidationException::withMessages([
                'code' => 'Invalid verification code.',
            ]);
        }

        $record->consumed_at = now();
        $record->save();

        Auth::login($user);
        $request->session()->forget(self::TWO_FACTOR_SESSION_KEY);
        $request->session()->regenerate();

        return redirect()->intended(route('admin-dashboard.index'));
    }

    public function resendTwoFactor(Request $request)
    {
        $userId = $request->session()->get(self::TWO_FACTOR_SESSION_KEY);
        if (! $userId) {
            return redirect()->route('admin-dashboard.login');
        }

        $user = User::query()->find($userId);
        if (! $user) {
            $request->session()->forget(self::TWO_FACTOR_SESSION_KEY);
            return redirect()->route('admin-dashboard.login');
        }

        $channels = $this->enabledTwoFactorChannelsForUser($user);
        if (count($channels) === 0) {
            $request->session()->forget([self::TWO_FACTOR_SESSION_KEY, self::TWO_FACTOR_CHANNELS_SESSION_KEY]);
            return redirect()->route('admin-dashboard.login');
        }

        $this->sendTwoFactorCode($user, $channels);
        $request->session()->put(self::TWO_FACTOR_CHANNELS_SESSION_KEY, $channels);

        return redirect()
            ->route('admin-dashboard.two-factor')
            ->with('success', 'A new verification code has been sent.');
    }

    /**
     * @param  array<int, string>  $channels
     */
    private function sendTwoFactorCode(User $user, array $channels): void
    {
        $code = (string) random_int(100000, 999999);

        TwoFactorCode::query()->create([
            'user_id' => $user->id,
            'code_hash' => Hash::make($code),
            'expires_at' => now()->addMinutes(10),
            'attempts' => 0,
        ]);

        $user->notify(new AdminTwoFactorCodeNotification($code, $channels));
    }

    /**
     * @return array<int, string>
     */
    private function enabledTwoFactorChannelsForUser(User $user): array
    {
        $enabled = (bool) SiteSetting::getValue('security.2fa.enabled', false);
        if (! $enabled) {
            return [];
        }

        $mailEnabled = (bool) SiteSetting::getValue('security.2fa.email_enabled', false);
        $smsEnabled = (bool) SiteSetting::getValue('security.2fa.sms_enabled', false);

        $channels = [];
        if ($mailEnabled) {
            $channels[] = 'mail';
        }
        if ($smsEnabled && filled($user->phone_number)) {
            $channels[] = 'rebueTextSms';
        }

        return $channels;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin-dashboard.login');
    }
}
