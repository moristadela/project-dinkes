<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="icon" href="https://dinkes.jatengprov.go.id/wp-content/uploads/2023/02/Logo-Provinsi-Jawa-Tengah-1-e1675238827781.png" type="image/png">

</head>
<body>
    
    @extends('layouts.app')

    @section('content')
    <div class="max-w-7xl mx-auto py-12 px-6 lg:px-8 bg-gray-50 rounded-2xl shadow-xl">

        <!-- Header dan Tombol -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">Daftar User</h2>
            <div x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }">
                <button @click="open = true"
                    class="px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-600 text-sm font-bold shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block -mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah User
                </button>
                
                <!-- Modal Tambah User -->
                <div x-show="open" 
                    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
                    x-transition>
                    <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
                        <h3 class="text-lg font-bold mb-4">Tambah User</h3>
                        
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
                                <label class="block text-sm font-medium">Seksi</label>
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
                                <button type="button" @click="open = false"
                                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
                            </div>
                        </form>
                        <button @click="open = false" 
                                class="absolute top-2 right-2 text-gray-600 hover:text-black">
                            ✕
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg relative mb-8 shadow-md" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto lg:overflow-x-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-50 hidden sm:table-header-group">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Seksi
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Bidang
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Role
                            </th>
                            <th scope="col" class="relative px-6 py-4 text-center">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="block sm:table-row hover:bg-blue-50 transition-colors duration-200 py-4 sm:py-0 border-b border-gray-200 sm:border-none">
                                <td class="px-6 py-2 text-sm font-medium text-gray-900 block sm:table-cell">
                                    <div class="font-bold sm:hidden text-xs text-gray-500 uppercase tracking-wider mb-1">Seksi</div>
                                    <span class="block break-words">{{ $user->name }}</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-600 block sm:table-cell">
                                    <div class="font-bold sm:hidden text-xs text-gray-500 uppercase tracking-wider mb-1">Bidang</div>
                                    {{ $user->bidang ? $user->bidang->nama_bidang : 'Tidak ada' }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-600 block sm:table-cell">
                                    <div class="font-bold sm:hidden text-xs text-gray-500 uppercase tracking-wider mb-1">Username</div>
                                    {{ $user->username }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-600 block sm:table-cell">
                                    <div class="font-bold sm:hidden text-xs text-gray-500 uppercase tracking-wider mb-1">Role</div>
                                    {{ ucfirst($user->role) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-left sm:text-right text-sm font-medium block sm:table-cell">
                                    <div class="font-bold sm:hidden text-xs text-gray-500 uppercase tracking-wider mb-2">Aksi</div>
                                    <div class="flex sm:justify-end space-x-3" x-data="{ openConfirm: false }">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                        class="inline-flex items-center justify-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors transform hover:-translate-y-0.5" title="Edit">Edit</a> 
                                        <button @click.prevent="openConfirm = true" 
                                            class="inline-flex items-center justify-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors transform hover:-translate-y-0.5" title="Hapus">
                                            Hapus
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div x-show="openConfirm" 
                                            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
                                            x-transition>
                                            <div class="bg-white rounded-lg shadow-lg w-80 p-6 relative">
                                                <h3 class="text-lg font-bold mb-4">Konfirmasi Hapus</h3>
                                                <p class="text-sm text-gray-600 mb-4">Apakah Anda yakin ingin menghapus user ini?</p>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" @click="openConfirm = false" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                                                    </form>
                                                </div>
                                                <button @click="openConfirm = false" class="absolute top-2 right-2 text-gray-600 hover:text-black">✕</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">
                                    Belum ada user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
    

</body>
</html>

