@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">User Management</h1>

        <div class="py-6" x-data="{ openModal: false }">
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
                            <!-- Dummy Data -->
                            <tr>
                                <td class="px-4 py-2 border">Andi Wijaya</td>
                                <td class="px-4 py-2 border">andi123</td>
                                <td class="px-4 py-2 border">Admin</td>
                                <td class="px-4 py-2 border text-center space-x-2">
                                    <button class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</button>
                                    <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 border">Siti Lestari</td>
                                <td class="px-4 py-2 border">siti001</td>
                                <td class="px-4 py-2 border">User</td>
                                <td class="px-4 py-2 border text-center space-x-2">
                                    <button class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</button>
                                    <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Tambah User -->
                <div x-show="openModal" 
                     class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center"
                     x-transition>
                    <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
                        <h3 class="text-lg font-bold mb-4">Tambah User</h3>

                        <form>
                            <div class="mb-3">
                                <label class="block text-sm font-medium">Nama</label>
                                <input type="text" class="w-full border rounded p-2" placeholder="Masukkan nama">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium">Username</label>
                                <input type="text" class="w-full border rounded p-2" placeholder="Masukkan username">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium">Role</label>
                                <select class="w-full border rounded p-2">
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
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