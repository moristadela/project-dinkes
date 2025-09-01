@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">
            Edit Kegiatan: {{ $microsite->title }}
        </h2>
        <a href="{{ route('admin.microsites.index') }}" 
           class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg shadow-sm 
                  hover:bg-gray-300 transition-colors">
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
        <form action="{{ route('admin.microsites.update', $microsite->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Nama Microsite --}}
                <div>
                    <label for="shortlink" class="block text-sm font-semibold text-gray-700">
                        Nama Microsite
                    </label>
                    <div class="mt-1 flex rounded-lg shadow-sm">
                        <span class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 
                                     bg-gray-100 text-gray-500 text-sm">
                            {{ url('/') }}/
                        </span>
                        <input type="text" name="shortlink" id="shortlink"
                               class="flex-1 block w-full rounded-r-lg border-gray-300 p-3 sm:text-sm 
                                      focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200 
                                      @error('shortlink') border-red-500 @enderror"
                               value="{{ old('shortlink', $microsite->shortlink) }}" required>
                    </div>
                    @error('shortlink')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Judul Microsite --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Kegiatan
                    </label>
                    <input type="text" name="title" id="title"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm p-3 sm:text-sm 
                                  focus:border-indigo-500 focus:ring-indigo-500 
                                  @error('title') border-red-500 @enderror"
                           value="{{ old('title', $microsite->title) }}" required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Kegiatan --}}
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">
                        Tanggal Kegiatan
                    </label>
                    <input type="text" name="tanggal" id="tanggal"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm p-3 sm:text-sm 
                                  focus:border-indigo-500 focus:ring-indigo-500 
                                  @error('tanggal') border-red-500 @enderror"
                           value="{{ old('tanggal', $microsite->tanggal) }}" required>
                    @error('tanggal')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bidang --}}
                @if(auth()->user()->role === 'admin')
                    <div>
                        <label for="bidang_id" class="block text-sm font-medium text-gray-700">
                            Bidang
                        </label>
                        <select name="bidang_id" id="bidang_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm 
                                       focus:border-blue-500 focus:ring-blue-500">
                            <option value="" hidden>-- Pilih Bidang --</option>
                            @foreach($bidangWithSeksi as $bidang)
                                <option value="{{ $bidang->id }}" 
                                    {{ old('bidang_id', $url->bidang_id ?? '') == $bidang->id ? 'selected' : '' }}>
                                    {{ $bidang->nama_bidang }}
                                </option>
                            @endforeach
                        </select>
                        @error('bidang_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 sm:text-sm 
                                bg-gray-100 text-gray-600">
                        {{ auth()->user()->bidang->nama_bidang ?? 'N/A' }}
                    </div>
                    <input type="hidden" name="bidang_id" value="{{ auth()->user()->bidang_id }}">
                @endif

                {{-- Dynamic Links Fieldset --}}
                <fieldset class="border-t border-gray-200 pt-6">
                    <legend class="text-base font-medium text-gray-900">Link-link</legend>
                    <p class="text-sm text-gray-500">
                        Tambahkan link yang ingin Anda tampilkan di microsite.
                    </p>

                    <div id="links-container" class="mt-4 space-y-4">
                        @php
                            $links = old('links', $microsite->daftarLinks->toArray());
                        @endphp

                        @forelse($links as $index => $link)
                            <div class="flex items-end space-x-2 link-group">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700">Judul Link</label>
                                    <input type="text" name="links[{{ $index }}][title]"
                                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                                           value="{{ $link['title'] ?? '' }}" placeholder="Contoh: WhatsApp">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700">URL</label>
                                    <input type="url" name="links[{{ $index }}][url]"
                                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                                           value="{{ $link['original_link'] ?? $link['url'] ?? '' }}" 
                                           placeholder="https://wa.me/...">
                                </div>
                                <button type="button" 
                                        class="remove-link-btn p-2 text-red-600 hover:text-red-800 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" 
                                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 
                                                 2 0 002 2h8a2 2 0 002-2V6a1 1 0 
                                                 100-2h-3.382l-.724-1.447A1 1 0 
                                                 0011 2H9zM7 8a1 1 0 012 0v6a1 1 
                                                 0 11-2 0V8zm6 0a1 1 0 10-2 
                                                 0v6a1 1 0 102 0V8z" 
                                              clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @empty
                            <div class="flex items-end space-x-2 link-group">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700">Judul Link</label>
                                    <input type="text" name="links[0][title]" 
                                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700">URL</label>
                                    <input type="url" name="links[0][url]" 
                                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm">
                                </div>
                                <button type="button" 
                                        class="remove-link-btn p-2 text-red-600 hover:text-red-800 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" 
                                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 
                                                 000 2v10a2 2 0 002 2h8a2 2 0 
                                                 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 
                                                 1 0 0011 2H9zM7 8a1 1 0 012 
                                                 0v6a1 1 0 11-2 0V8zm6 0a1 
                                                 1 0 10-2 0v6a1 1 0 102 0V8z" 
                                              clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @endforelse
                    </div>

                    <button type="button" id="add-link-btn" 
                            class="mt-4 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg 
                                   shadow-md hover:bg-indigo-700 transition-colors">
                        + Tambah Link
                    </button>
                </fieldset>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-green-600 text-white rounded-lg shadow-md 
                                   hover:bg-green-700 transition-colors">
                        Perbarui Microsite
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const linksContainer = document.getElementById('links-container');
    const addLinkBtn = document.getElementById('add-link-btn');
    let linkIndex = linksContainer.querySelectorAll('.link-group').length;

    function addLinkField() {
        const newLinkGroup = document.createElement('div');
        newLinkGroup.classList.add('flex', 'items-end', 'space-x-2', 'link-group');
        newLinkGroup.innerHTML = `
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700">Judul Link</label>
                <input type="text" name="links[\${linkIndex}][title]" 
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                       placeholder="Contoh: WhatsApp">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700">URL</label>
                <input type="url" name="links[\${linkIndex}][url]" 
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm"
                       placeholder="https://wa.me/...">
            </div>
            <button type="button" class="remove-link-btn p-2 text-red-600 hover:text-red-800 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" 
                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 
                             000 2v10a2 2 0 002 2h8a2 2 0 
                             002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 
                             1 0 0011 2H9zM7 8a1 1 0 012 
                             0v6a1 1 0 11-2 0V8zm6 0a1 
                             1 0 10-2 0v6a1 1 0 102 0V8z" 
                          clip-rule="evenodd" />
                </svg>
            </button>
        `;
        linksContainer.appendChild(newLinkGroup);
        linkIndex++;
    }

    addLinkBtn.addEventListener('click', addLinkField);
    linksContainer.addEventListener('click', function(event) {
        if (event.target.closest('.remove-link-btn')) {
            event.target.closest('.link-group').remove();
        }
    });
});
</script>
@endsection
