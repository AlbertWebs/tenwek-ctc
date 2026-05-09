@extends('admin-dashboard.layouts.app')

@section('title', 'Users & roles')
@section('header', 'Users & roles')

@section('content')
    @if($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800 shadow-sm">
            <p class="font-medium">Please fix the following:</p>
            <ul class="mt-2 list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="space-y-8" x-data="{ openEdit: null, openPw: null }">
        {{-- Create user --}}
        <div class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 sm:px-6 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-semibold text-gray-900">Add dashboard user</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Creates an account that can sign in at the admin login. Password must be at least 8 characters.</p>
                </div>
            </div>
            <div class="p-4 sm:p-6">
                @if($assignableRoles->isEmpty())
                    <p class="text-sm text-amber-800 bg-amber-50 border border-amber-200 rounded-lg px-4 py-3">
                        No admin roles found. Run <code class="text-xs bg-white px-1 rounded">php artisan db:seed --class=RoleAndPermissionSeeder</code> first.
                    </p>
                @else
                    <form action="{{ route('admin-dashboard.users.store') }}" method="post" class="grid grid-cols-1 lg:grid-cols-2 gap-4 max-w-4xl">
                        @csrf
                        <div>
                            <label for="create_name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                            <input type="text" name="name" id="create_name" value="{{ old('name') }}" required
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                            @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="create_email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email" id="create_email" value="{{ old('email') }}" required autocomplete="off"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="create_phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone number (optional)</label>
                            <input type="text" name="phone_number" id="create_phone_number" value="{{ old('phone_number') }}" autocomplete="off"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal"
                                   placeholder="+2547...">
                            @error('phone_number')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="create_password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                            <input type="password" name="password" id="create_password" required autocomplete="new-password"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                            @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="create_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm password *</label>
                            <input type="password" name="password_confirmation" id="create_password_confirmation" required autocomplete="new-password"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                        </div>
                        <div class="lg:col-span-2 flex flex-wrap items-end gap-4">
                            <div class="flex-1 min-w-[12rem]">
                                <label for="create_role_id" class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                                <select name="role_id" id="create_role_id" required
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                                    @foreach($assignableRoles as $role)
                                        <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">
                                Create user
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        {{-- Search + list --}}
        <div class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 sm:px-6 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-semibold text-gray-900">All users</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Change roles with the dropdown (saved immediately). Use Edit or Password for other changes.</p>
                </div>
                <form method="get" action="{{ route('admin-dashboard.users.index') }}" class="flex items-center gap-2">
                    <label for="user_search" class="sr-only">Search</label>
                    <input type="search" name="q" id="user_search" value="{{ request('q') }}" placeholder="Search name or email"
                           class="rounded-lg border border-gray-300 px-3 py-2 text-sm w-56 max-w-full focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                    <button type="submit" class="px-3 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">Search</button>
                    @if(request()->filled('q'))
                        <a href="{{ route('admin-dashboard.users.index') }}" class="text-sm text-admin-teal hover:underline">Clear</a>
                    @endif
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="admin-table min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Name</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Dashboard</th>
                            <th class="text-left">Role</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse($users as $user)
                            <tr class="align-middle">
                                <td class="text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                    @if($user->id === auth()->id())
                                        <span class="ml-1 text-xs font-normal text-admin-teal">(you)</span>
                                    @endif
                                </td>
                                <td class="text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="text-sm">
                                    @if($user->isAdmin())
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Yes</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-600">No</span>
                                    @endif
                                </td>
                                <td class="text-sm">
                                    <form action="{{ route('admin-dashboard.users.update-role', $user) }}" method="post" class="inline-block min-w-[10rem]">
                                        @csrf
                                        @method('PUT')
                                        <label class="sr-only" for="role_{{ $user->id }}">Role for {{ $user->name }}</label>
                                        <select name="role_id" id="role_{{ $user->id }}" onchange="this.form.submit()"
                                                class="w-full max-w-[14rem] rounded-lg border border-gray-300 text-sm py-1.5 pr-8 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                                            <option value="">No role</option>
                                            @foreach($assignableRoles as $role)
                                                <option value="{{ $role->id }}" @selected($user->role_id == $role->id)>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="text-right text-sm whitespace-nowrap">
                                    <button type="button" @click="openEdit = openEdit === {{ $user->id }} ? null : {{ $user->id }}; openPw = null"
                                            class="text-admin-teal hover:underline mr-3">Edit</button>
                                    <button type="button" @click="openPw = openPw === {{ $user->id }} ? null : {{ $user->id }}; openEdit = null"
                                            class="text-gray-700 hover:underline mr-3">Password</button>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin-dashboard.users.destroy', $user) }}" method="post" class="inline" onsubmit="return confirm('Delete {{ $user->name }}? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            <tr x-show="openEdit === {{ $user->id }}" x-cloak class="bg-admin-bg/40">
                                <td colspan="5" class="px-4 py-4 sm:px-6">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-3">Edit user</p>
                                    <form action="{{ route('admin-dashboard.users.update', $user) }}" method="post" class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-2xl">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1" for="edit_name_{{ $user->id }}">Name</label>
                                            <input type="text" name="name" id="edit_name_{{ $user->id }}" value="{{ $user->name }}" required
                                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1" for="edit_email_{{ $user->id }}">Email</label>
                                            <input type="email" name="email" id="edit_email_{{ $user->id }}" value="{{ $user->email }}" required
                                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1" for="edit_phone_{{ $user->id }}">Phone number (optional)</label>
                                            <input type="text" name="phone_number" id="edit_phone_{{ $user->id }}" value="{{ $user->phone_number }}"
                                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal"
                                                   placeholder="+2547...">
                                        </div>
                                        <div class="sm:col-span-2 flex gap-2">
                                            <button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark">Save</button>
                                            <button type="button" @click="openEdit = null" class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr x-show="openPw === {{ $user->id }}" x-cloak class="bg-admin-bg/40">
                                <td colspan="5" class="px-4 py-4 sm:px-6">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-3">Set new password</p>
                                    <form action="{{ route('admin-dashboard.users.update-password', $user) }}" method="post" class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-2xl">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1" for="pw_{{ $user->id }}">New password</label>
                                            <input type="password" name="password" id="pw_{{ $user->id }}" required autocomplete="new-password" minlength="8"
                                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1" for="pw_conf_{{ $user->id }}">Confirm</label>
                                            <input type="password" name="password_confirmation" id="pw_conf_{{ $user->id }}" required autocomplete="new-password" minlength="8"
                                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                                        </div>
                                        <div class="sm:col-span-2 flex gap-2">
                                            <button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark">Update password</button>
                                            <button type="button" @click="openPw = null" class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-12 text-sm">
                                    @if(request()->filled('q'))
                                        No users match your search. <a href="{{ route('admin-dashboard.users.index') }}" class="text-admin-teal hover:underline">Clear search</a>.
                                    @else
                                        No users in the database.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

        {{-- Roles reference --}}
        <div class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
                <h2 class="text-base font-semibold text-gray-900">Roles & permissions</h2>
                <p class="text-sm text-gray-500 mt-0.5">Super Admin and Editor can sign in. Permissions limit which menu areas appear.</p>
            </div>
            <div class="p-4 sm:p-6">
                <dl class="grid gap-4 sm:grid-cols-2">
                    @foreach($roles as $role)
                        <div class="border border-gray-200 rounded-lg p-4 h-full">
                            <dt class="text-sm font-semibold text-gray-900">{{ $role->name }}</dt>
                            <dd class="mt-1 text-xs text-gray-500 font-mono">{{ $role->slug }}</dd>
                            <dd class="mt-2 text-sm text-gray-600">
                                <span class="text-gray-500">{{ $role->users_count }} user(s)</span>
                            </dd>
                            <dd class="mt-3">
                                @php
                                    $byGroup = $role->permissions->groupBy('group');
                                @endphp
                                @forelse($byGroup as $group => $perms)
                                    <div class="mt-2 first:mt-0">
                                        <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">{{ $group ?: 'general' }}</p>
                                        <ul class="mt-1 space-y-0.5 text-sm text-gray-700">
                                            @foreach($perms as $perm)
                                                <li>{{ $perm->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500">No permissions</p>
                                @endforelse
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
@endsection
