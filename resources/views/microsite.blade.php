@extends('layouts.app') {{-- Menggunakan layout utama yang sudah ada --}}

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-sm">
    <div class="flex items-center space-x-4 mb-6">
        <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back
        </a>
        <button class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete Microsite</button>
    </div>

    <div class="flex items-center justify-between mb-6 border-b pb-4">
        <h2 class="text-xl font-semibold text-gray-800">Microsite - <a href="#" class="text-blue-600">http://127.0.0.1:8000/rizkykurniawan</a></h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Microsite Data (Left Column) --}}
        <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-600">Microsite Data</h3>
            <div class="space-y-4">
                {{-- Form fields --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="Rizky Kurniawan">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">Backend Engineer at Ruang Developer</textarea>
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" id="slug" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="rizkykurniawan">
                </div>
                <div>
                    <label for="logo-url" class="block text-sm font-medium text-gray-700">Logo URL</label>
                    <input type="text" id="logo-url" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="https://avatars.githubusercontent.com/u/55426692?v=4">
                </div>
            </div>

            {{-- Microsite Links --}}
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Microsite Links</h3>
                <div class="space-y-4">
                    {{-- Link 1 --}}
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium">Link Text</span>
                            <button class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.332 21H7.668a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </div>
                        <input type="text" class="block w-full border border-gray-300 rounded-md shadow-sm p-2 mb-2" value="Website">
                        <label for="link-url-1" class="block text-sm font-medium text-gray-700">Link URL</label>
                        <input type="text" id="link-url-1" class="block w-full border border-gray-300 rounded-md shadow-sm p-2 mb-2" value="https://www.rizkykurniawan.id">
                        <div class="flex space-x-2">
                            <input type="text" class="flex-1 border border-gray-300 rounded-md shadow-sm p-2" placeholder="Link Icon" value="bi bi-globe">
                            <select class="border border-gray-300 rounded-md shadow-sm p-2">
                                <option>New Tab</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Microsite Preview (Right Column) --}}
        <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-600">Microsite Preview</h3>
            <div class="bg-orange-100 p-6 rounded-lg flex flex-col items-center justify-center">
                <img src="http://googleusercontent.com/file_content/2" alt="Rizky Kurniawan" class="w-24 h-24 rounded-full border-4 border-white mb-4 shadow-lg">
                <h4 class="text-xl font-semibold text-gray-900">Rizky Kurniawan</h4>
                <p class="text-sm text-gray-600 mb-6">Backend Engineer at Ruang Developer</p>
                <div class="w-full max-w-sm space-y-4">
                    <div class="bg-white rounded-xl shadow-md p-4 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="text-blue-600"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM17.5 7h-11A1.5 1.5 0 005 8.5v7A1.5 1.5 0 006.5 17h11A1.5 1.5 0 0019 15.5v-7A1.5 1.5 0 0017.5 7zM16 11.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5z"></path></svg></div>
                            <span class="text-gray-800">Website</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection