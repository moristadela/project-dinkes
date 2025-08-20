<div x-data="{ open: false }" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        {{-- Background overlay --}}
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        {{-- Modal container --}}
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Buat Shortlink Baru
                        </h3>
                        <div class="mt-2">
                            <form action="#" method="POST">
                                @csrf

                                {{-- Title --}}
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>

                                {{-- Original URL --}}
                                <div class="mb-4">
                                    <label for="original_url" class="block text-sm font-medium text-gray-700">Original URL</label>
                                    <input type="url" name="original_url" id="original_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>

                                {{-- Short URL --}}
                                <div class="mb-4">
                                    <label for="short_url" class="block text-sm font-medium text-gray-700">Short URL</label>
                                    <input type="text" name="short_url" id="short_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>

                                {{-- Bidang --}}
                                <div class="mb-4">
                                    <label for="bidang_id" class="block text-sm font-medium text-gray-700">Bidang</label>
                                    <select name="bidang_id" id="bidang_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                        {{-- Opsi akan diisi dari database --}}
                                        <option value="">Pilih Bidang</option>
                                    </select>
                                </div>

                                {{-- Seksi --}}
                                <div class="mb-4">
                                    <label for="seksi_id" class="block text-sm font-medium text-gray-700">Seksi</label>
                                    <select name="seksi_id" id="seksi_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                        {{-- Opsi akan diisi dari database --}}
                                        <option value="">Pilih Seksi</option>
                                    </select>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" form="create-shortlink-form" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>