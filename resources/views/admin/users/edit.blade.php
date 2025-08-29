@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit User</h1>

        <div class="bg-white shadow-md rounded-lg p-6">

            <!-- Form Edit User -->
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                        <ul class="mt-3 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full border rounded p-2" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                        class="w-full border rounded p-2" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role" id="role" class="w-full border rounded p-2" required>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                
                {{-- Bidang input (read-only) --}}
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Bidang</label>
                    {{-- Menampilkan nama bidang sebagai teks biasa --}}
                    <p class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100">
                        {{ $user->bidang->nama_bidang ?? 'Tidak ada bidang' }}
                    </p>
                    {{-- Menyertakan input tersembunyi untuk mengirimkan ID bidang --}}
                    <input type="hidden" name="bidang_id" value="{{ $user->bidang_id }}">
                </div>
                

                <div class="mb-3">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin mengubah"
                        class="w-full border rounded p-2">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full border rounded p-2">
                </div>

                <div class="flex justify-end space-x-2 mt-6">
                    <a href="{{ route('admin.users.index') }}" 
                        class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Perbarui User</button>
                </div>
            </form>
        </div>
    </div>
@endsection
