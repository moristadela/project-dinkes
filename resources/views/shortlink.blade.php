@extends('layouts.app')

@section('content')
<div class="bg-blue-200 min-h-screen flex flex-col items-center justify-center p-6" 
     x-data="{ shortUrl: '', showResult: false }">

    <div class="relative z-10 w-full max-w-2xl text-center text-white px-6">
        <h1 class="text-4xl font-bold mb-6">
            Generate Short URL Easily<br>with Dinkes Jateng Shortener!
        </h1>

        <!-- Form -->
        <form @submit.prevent="
                fetch('{{ route('shortlink.generate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        original_url: $event.target.original_url.value
                    })
                })
                .then(res => res.json())
                .then(data => {
                    shortUrl = data.short_url;
                    showResult = true;
                })
        " 
        class="flex rounded-lg overflow-hidden shadow-md bg-white">

            <input type="text" name="original_url" placeholder="Paste your long URL..." 
                   class="flex-1 px-4 py-3 text-gray-700 focus:outline-none">
            <button type="submit" 
                    class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 font-semibold transition duration-200">
                Get Short URL
            </button>
        </form>

        <!-- Result Box -->
        <div x-show="showResult" 
             x-transition 
             class="mt-6 bg-green-100 border border-green-300 text-green-800 rounded-lg p-4 text-left">
            <p class="font-semibold">Your short URL:</p>
            <p class="mt-2 text-blue-700 font-mono">
                <a :href="shortUrl" x-text="shortUrl" target="_blank"></a>
            </p>

            <div class="mt-4 flex space-x-3">
                <button @click="alert('Saved!')" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Save
                </button>
                <button @click="showResult = false" 
                        class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
