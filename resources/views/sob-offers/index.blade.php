@extends('layouts.app')

@section('content')

<div class="p-6 bg-white dark:bg-gray-800 transition-all duration-300 mt-20">

    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Manage Offers</h2>

    @if(session('message'))
        <p class="text-green-600 dark:text-green-400">{{ session('message') }}</p>
    @endif

    @if($errors->any())
        <div class="bg-red-500 dark:bg-red-700 text-white p-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sob-offers.store') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
        @csrf
        <input type="text" name="title" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" placeholder="Title" required>

        <div>
            <input id="description" type="hidden" name="description" value="{{ old('description') }}">
            <trix-editor input="description" class="w-full min-h-[200px]  bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 p-2 rounded"></trix-editor>
        </div>

        <input type="date" name="offer_start_date" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" required>
        <input type="date" name="end_date" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" required>

        <select name="category_id" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <input type="file" name="featured_image" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded">
        <input type="text" name="tags" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" placeholder="Tags (comma-separated)">

        <button type="submit" class="w-full bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-800 p-2 rounded text-white">Save Offer</button>
    </form>

    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mt-6">Offers List</h3>
    <table class="w-full mt-4 border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                <th class="p-2">Title</th>
                <th class="p-2">Category</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
                <tr class="border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-white">
                    <td class="p-2">{{ $offer->title }}</td>
                    <td class="p-2">{{ $offer->category->name }}</td>
                    <td class="p-2">
                        <form action="{{ route('sob-offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 dark:bg-red-700 hover:bg-red-700 dark:hover:bg-red-800 p-1 text-white rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Dark mode toggle
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    });
</script>

@endsection
