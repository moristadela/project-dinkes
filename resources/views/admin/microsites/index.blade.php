<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microsite</title>
</head>
<body>

    @extends('layouts.app')

    @section('content')
    <div class="max-w-7xl mx-auto py-12 px-6 lg:px-8 bg-gray-50 rounded-2xl shadow-xl">

        <!-- Header and Button -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">Daftar Microsite</h2>
            <a href="{{ route('admin.microsites.create') }}"
            class="px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-6000 text-sm font-bold shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block -mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Buat Microsite Baru
            </a>
        </div>

        <!-- Success Notification -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg relative mb-8 shadow-md" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Microsite Table --}}
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Judul
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Shortlink
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Seksi
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Bidang
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal Dibuat
                            </th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($microsites as $microsite)
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $microsite->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                                    <a href="/m/{{ $microsite->shortlink }}" target="_blank" class="hover:underline font-medium">
                                        s.id/{{ $microsite->shortlink }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $microsite->user->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $microsite->bidang->nama_bidang ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $microsite->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('admin.microsites.edit', $microsite->id) }}"
                                        class="inline-flex items-center justify-center w-16 h-8 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors transform hover:-translate-y-0.5"
                                        title="Edit">Edit</a>
                                        <form action="{{ route('admin.microsites.destroy', $microsite->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus microsite ini?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-16 h-8 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors transform hover:-translate-y-0.5"
                                                    title="Hapus">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic">
                                    Belum ada microsite yang dibuat.
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


