<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()->with('role')->orderBy('name');

        if ($search = $request->string('q')->trim()->toString()) {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        }

        $users = $query->paginate(15)->withQueryString();

        $roles = Role::query()
            ->withCount('users')
            ->with(['permissions' => fn ($q) => $q->orderBy('group')->orderBy('name')])
            ->orderBy('name')
            ->get();

        $assignableRoles = Role::query()->forAdminDashboard()->orderBy('name')->get();

        return view('admin-dashboard.users.index', compact('users', 'roles', 'assignableRoles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $allowedRoleIds = Role::query()->forAdminDashboard()->pluck('id')->all();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'integer', Rule::in($allowedRoleIds)],
        ]);

        User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number') ?: null,
            'password' => $request->input('password'),
            'role_id' => $request->input('role_id'),
        ]);

        return redirect()
            ->route('admin-dashboard.users.index')
            ->with('success', 'Dashboard user created. They can sign in with the email and password you set.');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone_number' => ['nullable', 'string', 'max:30'],
        ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number') ?: null,
        ]);

        return redirect()
            ->route('admin-dashboard.users.index')
            ->with('success', 'User details updated.');
    }

    public function updatePassword(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => $request->input('password'),
        ]);

        return redirect()
            ->route('admin-dashboard.users.index')
            ->with('success', 'Password updated for '.$user->email.'.');
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $allowedRoleIds = Role::query()->forAdminDashboard()->pluck('id')->all();

        $request->validate([
            'role_id' => ['nullable', 'integer', Rule::in($allowedRoleIds)],
        ]);

        $newRoleId = $request->input('role_id') ?: null;
        $newRole = $newRoleId ? Role::query()->find($newRoleId) : null;

        if ($user->id === $request->user()->id && $user->isAdmin()) {
            $stillAdmin = $newRole && $newRole->isAdminEligible();
            if (! $stillAdmin) {
                $otherAdmins = User::query()
                    ->where('id', '!=', $user->id)
                    ->whereHas('role', fn ($q) => $q->forAdminDashboard())
                    ->count();
                if ($otherAdmins === 0) {
                    return redirect()
                        ->route('admin-dashboard.users.index')
                        ->with('error', 'You cannot remove the last admin dashboard user.');
                }
            }

            $hadUserManage = $user->role?->hasPermission('users.manage') ?? false;
            $willHaveUserManage = $newRole?->hasPermission('users.manage') ?? false;
            if ($hadUserManage && ! $willHaveUserManage) {
                $others = User::query()
                    ->where('id', '!=', $user->id)
                    ->whereHas('role.permissions', fn ($q) => $q->where('slug', 'users.manage'))
                    ->count();
                if ($others === 0) {
                    return redirect()
                        ->route('admin-dashboard.users.index')
                        ->with('error', 'You cannot remove user management from yourself while you are the only user manager.');
                }
            }
        }

        $user->update(['role_id' => $newRoleId]);

        return redirect()
            ->route('admin-dashboard.users.index')
            ->with('success', 'User role updated.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return redirect()
                ->route('admin-dashboard.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        if ($user->isAdmin()) {
            $otherAdmins = User::query()
                ->where('id', '!=', $user->id)
                ->whereHas('role', fn ($q) => $q->forAdminDashboard())
                ->count();
            if ($otherAdmins === 0) {
                return redirect()
                    ->route('admin-dashboard.users.index')
                    ->with('error', 'Cannot delete the last admin dashboard user.');
            }
        }

        if ($user->role?->hasPermission('users.manage')) {
            $others = User::query()
                ->where('id', '!=', $user->id)
                ->whereHas('role.permissions', fn ($q) => $q->where('slug', 'users.manage'))
                ->count();
            if ($others === 0) {
                return redirect()
                    ->route('admin-dashboard.users.index')
                    ->with('error', 'Cannot delete the only remaining user manager.');
            }
        }

        $user->delete();

        return redirect()
            ->route('admin-dashboard.users.index')
            ->with('success', 'User removed.');
    }
}
