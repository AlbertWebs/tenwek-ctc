<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('role')->orderBy('name')->get();
        $roles = Role::withCount('users')->with('permissions')->get();
        return view('admin-dashboard.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $request->validate(['role_id' => 'nullable|exists:roles,id']);
        $user->update(['role_id' => $request->input('role_id') ?: null]);
        return redirect()->route('admin-dashboard.users.index')->with('success', 'User role updated.');
    }
}
