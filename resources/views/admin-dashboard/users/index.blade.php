@extends('admin-dashboard.layouts.app')

@section('title', 'Users & roles')
@section('header', 'Users & roles')

@section('content')
    <div class="space-y-8">
        <div class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
                <h2 class="text-base font-semibold text-gray-900">Users</h2>
                <p class="text-sm text-gray-500 mt-0.5">Assign a role to control dashboard access and permissions.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Role</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900 sm:px-6">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 sm:px-6">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-sm sm:px-6">
                                    <span class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-700">{{ $user->role?->name ?? 'No role' }}</span>
                                </td>
                                <td class="px-4 py-3 text-right text-sm sm:px-6">
                                    <form action="{{ route('admin-dashboard.users.update-role', $user) }}" method="post" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="role_id" onchange="this.form.submit()" class="rounded-lg border border-gray-300 text-sm py-1.5 pr-8 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                                            <option value="">No role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
                <h2 class="text-base font-semibold text-gray-900">Roles & permissions</h2>
                <p class="text-sm text-gray-500 mt-0.5">Only users with an admin role (Super Admin or Editor) can log in. Permissions control which sections they can access.</p>
            </div>
            <div class="p-4 sm:p-6">
                <dl class="space-y-4">
                    @foreach($roles as $role)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-900">{{ $role->name }}</dt>
                            <dd class="mt-1 text-sm text-gray-600">
                                <span class="text-gray-500">{{ $role->users_count }} user(s).</span>
                                Permissions: {{ $role->permissions->pluck('name')->join(', ') ?: 'None' }}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
@endsection
