@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">User Management</h1>

        <!-- Pastikan modal terbuka jika ada error validasi -->
        <div class="py-6" x-data="{ openModal: {{ $errors->any() ? 'true' : 'false' }} }">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-6">

                    <!-- Header + Button Tambah User -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Daftar User</h3>
                        <button @click="openModal = true"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                            + Tambah User
                        </button>
                    </div>

                    <!-- Tabel User -->
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="px-4 py-2 border">Nama</th>
                                    <th class="px-4 py-2 border">Username</th>
                                    <th class="px-4 py-2 border">Role</th>
                                    <th class="px-4 py-2 border text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                                        <td class="px-4 py-2 border">{{ $user->username }}</td>
                                        <td class="px-4 py-2 border">{{ ucfirst($user->role) }}</td>
                                        <td class="px-4 py-2 border text-center space-x-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                                            class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</a> 
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus user ini?')"
                                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 border text-center text-gray-500">Belum ada user</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Tambah User -->
                    <div x-show="openModal" 
                        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center"
                        x-transition>
                        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
                            <h3 class="text-lg font-bold mb-4">Tambah User</h3>
                            
                            <!-- Menampilkan pesan error validasi -->
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

                            <form action="{{ route('admin.users.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="block text-sm font-medium">Nama</label>
                                    <input type="text" name="name" class="w-full border rounded p-2" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium">Username</label>
                                    <input type="text" name="username" class="w-full border rounded p-2" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium">Password</label>
                                    <input type="password" name="password" class="w-full border rounded p-2" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium">Role</label>
                                    <select name="role" class="w-full border rounded p-2">
                                        <option value="admin">Admin</option>
                                        <option value="user" selected>User</option>
                                    </select>
                                </div>

                                {{-- TAMBAHAN INPUT BIDANG DI SINI --}}
                                <div class="mb-3">
                                    <label class="block text-sm font-medium">Bidang</label>
                                    <select name="bidang_id" class="w-full border rounded p-2" required>
                                        <option value="" disabled selected>Pilih Bidang</option>
                                        @foreach($bidangs as $bidang)
                                            <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="flex justify-end space-x-2">
                                    <button type="button" @click="openModal = false"
                                        class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
                                </div>
                            </form>

                            <!-- Close Button -->
                            <button @click="openModal = false" 
                                    class="absolute top-2 right-2 text-gray-600 hover:text-black">
                                ✕
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
