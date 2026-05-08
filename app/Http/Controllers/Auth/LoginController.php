<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TwoFactorCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private const TWO_FACTOR_SESSION_KEY = 'admin_2fa_user_id';

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

        // Step 1 ok → require step 2 for admin dashboard
        $this->sendTwoFactorCode($user);
        $request->session()->put(self::TWO_FACTOR_SESSION_KEY, $user->id);

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

        $this->sendTwoFactorCode($user);

        return redirect()
            ->route('admin-dashboard.two-factor')
            ->with('success', 'A new verification code has been sent.');
    }

    private function sendTwoFactorCode(User $user): void
    {
        $code = (string) random_int(100000, 999999);

        TwoFactorCode::query()->create([
            'user_id' => $user->id,
            'code_hash' => Hash::make($code),
            'expires_at' => now()->addMinutes(10),
            'attempts' => 0,
        ]);

        $subject = 'Your Tenwek CTC admin verification code';
        $body = "Your verification code is: {$code}\n\nThis code expires in 10 minutes.\n\nIf you did not attempt to log in, you can ignore this email.";

        Mail::raw($body, function ($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin-dashboard.login');
    }
}
