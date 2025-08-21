<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white shadow rounded-lg p-6">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" value="{{ $user->username }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password (Kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Role</label>
                <select name="role" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
