@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Buat Microsite Baru</h2>
        <a href="{{ route('admin.microsites.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg shadow-sm hover:bg-gray-300 transition-colors">
            Kembali
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
        <form action="{{ route('admin.microsites.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <!-- Shortlink -->
                <div>
                    <label for="shortlink" class="block text-sm font-medium text-gray-700">Shortlink</label>
                    <div class="mt-1 relative rounded-lg shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">s.id/</span>
                        </div>
                        <input type="text" name="shortlink" id="shortlink"
                               class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg @error('shortlink') border-red-500 @enderror"
                               value="{{ old('shortlink') }}" required>
                    </div>
                    @error('shortlink')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Microsite</label>
                    <input type="text" name="title" id="title"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('title') border-red-500 @enderror"
                            value="{{ old('title') }}" required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Bidang & Seksi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="bidang" class="block text-sm font-medium text-gray-700">Bidang</label>
                        <select id="bidang" name="bidang"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('bidang') border-red-500 @enderror" required>
                            <option value="">-- Pilih Bidang --</option>
                            @foreach($allBidang as $bidang)
                                <option value="{{ $bidang->id }}" {{ old('bidang') == $bidang->id ? 'selected' : '' }}>{{ $bidang->nama_bidang }}</option>
                            @endforeach
                        </select>
                        @error('bidang')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="seksi" class="block text-sm font-medium text-gray-700">Seksi</label>
                        <select id="seksi" name="seksi"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('seksi') border-red-500 @enderror" required>
                            <option value="">-- Pilih Seksi --</option>
                        </select>
                        @error('seksi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Dynamic Links Fieldset -->
                <fieldset class="border-t border-gray-200 pt-6">
                    <legend class="text-base font-medium text-gray-900">Link-link</legend>
                    <p class="text-sm text-gray-500">Tambahkan link yang ingin Anda tampilkan di microsite.</p>
                    <div id="links-container" class="mt-4 space-y-4">
                        <!-- Initial link fields -->
                        @if(old('links'))
                            @foreach(old('links') as $index => $link)
                                <div class="flex items-end space-x-2 link-group">
                                    <div class="flex-1">
                                        <label for="links[{{ $index }}][title]" class="block text-sm font-medium text-gray-700">Judul Link</label>
                                        <input type="text" name="links[{{ $index }}][title]" id="links[{{ $index }}][title]"
                                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                                               value="{{ $link['title'] }}" placeholder="Contoh: WhatsApp">
                                    </div>
                                    <div class="flex-1">
                                        <label for="links[{{ $index }}][url]" class="block text-sm font-medium text-gray-700">URL</label>
                                        <input type="url" name="links[{{ $index }}][url]" id="links[{{ $index }}][url]"
                                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                                               value="{{ $link['url'] }}" placeholder="https://wa.me/...">
                                    </div>
                                    <button type="button" class="remove-link-btn p-2 text-red-600 hover:text-red-800 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-end space-x-2 link-group">
                                <div class="flex-1">
                                    <label for="links[0][title]" class="block text-sm font-medium text-gray-700">Judul Link</label>
                                    <input type="text" name="links[0][title]" id="links[0][title]"
                                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                                           >
                                </div>
                                <div class="flex-1">
                                    <label for="links[0][url]" class="block text-sm font-medium text-gray-700">URL</label>
                                    <input type="url" name="links[0][url]" id="links[0][url]"
                                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                                           >
                                </div>
                                <button type="button" class="remove-link-btn p-2 text-red-600 hover:text-red-800 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" id="add-link-btn" class="mt-4 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-indigo-700 transition-colors">
                        + Tambah Link
                    </button>
                </fieldset>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transition-colors">
                        Buat Microsite
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Data bidang dan seksi dari PHP
    const allBidang = @json($allBidang);

    document.addEventListener('DOMContentLoaded', function() {
        const bidangSelect = document.getElementById('bidang');
        const seksiSelect = document.getElementById('seksi');
        const linksContainer = document.getElementById('links-container');
        const addLinkBtn = document.getElementById('add-link-btn');
        let linkIndex = linksContainer.querySelectorAll('.link-group').length;

        // Populate seksi dropdown based on selected bidang
        function populateSeksi() {
            const selectedBidangId = bidangSelect.value;
            seksiSelect.innerHTML = '<option value="">-- Pilih Seksi --</option>';
            if (selectedBidangId) {
                const selectedBidang = allBidang.find(b => b.id == selectedBidangId);
                if (selectedBidang && selectedBidang.seksi) {
                    selectedBidang.seksi.forEach(seksi => {
                        const option = document.createElement('option');
                        option.value = seksi.id;
                        option.textContent = seksi.nama_seksi;
                        if ('{{ old('seksi') }}' == seksi.id) {
                            option.selected = true;
                        }
                        seksiSelect.appendChild(option);
                    });
                }
            }
        }

        // Add a new link field
        function addLinkField() {
            const newLinkGroup = document.createElement('div');
            newLinkGroup.classList.add('flex', 'items-end', 'space-x-2', 'link-group');
            newLinkGroup.innerHTML = `
                <div class="flex-1">
                    <label for="links[${linkIndex}][title]" class="block text-sm font-medium text-gray-700">Judul Link</label>
                    <input type="text" name="links[${linkIndex}][title]" id="links[${linkIndex}][title]"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                           >
                </div>
                <div class="flex-1">
                    <label for="links[${linkIndex}][url]" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="url" name="links[${linkIndex}][url]" id="links[${linkIndex}][url]"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                           >
                </div>
                <button type="button" class="remove-link-btn p-2 text-red-600 hover:text-red-800 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            linksContainer.appendChild(newLinkGroup);
            linkIndex++;
        }

        // Event Listeners
        bidangSelect.addEventListener('change', populateSeksi);
        addLinkBtn.addEventListener('click', addLinkField);
        linksContainer.addEventListener('click', (event) => {
            if (event.target.closest('.remove-link-btn')) {
                const linkGroup = event.target.closest('.link-group');
                linkGroup.remove();
            }
        });

        // Initial call to populate seksi if an old value exists
        populateSeksi();
    });
</script>
@endsection
