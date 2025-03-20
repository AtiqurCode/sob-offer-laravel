
<div class="p-6 bg-gray-800 rounded-lg mt-100">
    <h2 class="text-xl font-semibold text-white">Manage Offers</h2>

    {{-- Success message --}}
    @if (session()->has('message'))
        <div class="p-2 bg-green-600 text-white rounded">{{ session('message') }}</div>
    @endif

     {{ json_encode($offers) }}

    <form wire:submit.prevent="store" class="mt-4 space-y-4">
        <input type="text" wire:model="title" class="w-full bg-gray-900 text-white p-2 rounded" placeholder="Title">
        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        {{-- WYSIWYG Editor for Description --}}
        <div wire:ignore>
            <trix-editor class="w-full bg-gray-900 text-white p-2 rounded" wire:model.defer="description"></trix-editor>
        </div>
        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="date" wire:model="offer_start_date" class="w-full bg-gray-900 text-white p-2 rounded">
        @error('offer_start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="date" wire:model="end_date" class="w-full bg-gray-900 text-white p-2 rounded">
        @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <select wire:model="category_id" class="w-full bg-gray-900 text-white p-2 rounded">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="file" wire:model="featured_image" class="w-full bg-gray-900 text-white p-2 rounded">
        @error('featured_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="text" wire:model="tags" class="w-full bg-gray-900 text-white p-2 rounded" placeholder="Tags (comma-separated)">
        @error('tags') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 p-2 rounded text-white">Save Offer</button>
    </form>

    {{-- Offers List --}}
    <h3 class="text-lg font-semibold text-white mt-6">Offers List</h3>
    <table class="w-full mt-4 border border-gray-700 text-white">
        <thead>
            <tr class="bg-gray-700">
                <th class="p-2">Title</th>
                <th class="p-2">Category</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
                <tr class="border border-gray-700">
                    <td class="p-2">{{ $offer->title }}</td>
                    <td class="p-2">{{ $offer->category->name }}</td>
                    <td class="p-2">
                        <button wire:click="edit({{ $offer->id }})" class="bg-yellow-600 hover:bg-yellow-700 p-1 text-white rounded">Edit</button>
                        <button wire:click="delete({{ $offer->id }})" class="bg-red-600 hover:bg-red-700 p-1 text-white rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
