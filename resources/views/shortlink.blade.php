@extends('layouts.shortlink')

@section(section: 'content')
<div class="bg-blue-200 min-h-full flex flex-col items-center justify-center p-6">
    <!-- Background -->
    <div class="absolute inset-0">
        <img class="h-full object-cover opacity-80">
    </div>

    <!-- Content -->
    <div class="relative z-10 w-full max-w-2xl text-center text-white px-6">
        <h1 class="text-4xl font-bold mb-6">
            Generate Short URL Easily<br>with URL Shortener!
        </h1>

        <form method="POST" action="#" class="flex rounded-lg overflow-hidden shadow-md">
            @csrf
            <input type="text" name="original_url" placeholder="Paste your long URL..." class="flex-1 px-4 py-3 text-gray-700 focus:outline-none">
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 font-semibold transition duration-200">
                Get Short URL
            </button>
        </form>
    </div>
</div>
@endsection