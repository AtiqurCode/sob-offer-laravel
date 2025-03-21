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

        <div class="mx-auto max-w-xs">
            <label for="example1" class="mb-1 block text-sm font-medium text-gray-700">Upload file</label>
            <input id="example1" name="featured_image" type="file" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-blue-600 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
        </div>

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
                        <button onclick="openEditModal({{ $offer }})" class="bg-yellow-500 dark:bg-yellow-600 hover:bg-yellow-600 dark:hover:bg-yellow-700 p-1 text-white rounded">Edit</button>
                        <form action="{{ route('sob-offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
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

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow-lg w-full max-w-lg mt-30">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Edit Offer</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="text" name="title" id="editTitle" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" placeholder="Title" required>
            <div>
                <input id="editDescription" type="hidden" name="description">
                <trix-editor input="editDescription" class="w-full min-h-[200px] bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 p-2 rounded"></trix-editor>
            </div>
            <input type="date" name="offer_start_date" id="editOfferStartDate" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" required>
            <input type="date" name="end_date" id="editEndDate" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" required>
            <select name="category_id" id="editCategoryId" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div>
                <label for="editFeaturedImage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload file</label>
                <input type="file" name="featured_image" id="editFeaturedImage" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-blue-600 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60">
            </div>
            <input type="text" name="tags" id="editTags" class="w-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white p-2 rounded" placeholder="Tags (comma-separated)">
            <button type="submit" class="w-full bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-800 p-2 rounded text-white mt-4">Update Offer</button>
        </form>
        <button onclick="closeEditModal()" class="mt-4 w-full bg-gray-600 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-800 p-2 rounded text-white">Cancel</button>
    </div>
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

    function openEditModal(offer) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editForm').action = `/sob-offers/${offer.id}`;
        document.getElementById('editTitle').value = offer.title;
        document.getElementById('editDescription').value = offer.description;
        document.getElementById('editOfferStartDate').value = offer.offer_start_date;
        document.getElementById('editEndDate').value = offer.end_date;
        document.getElementById('editCategoryId').value = offer.category_id;
        const tags = offer.tags.map(tag => tag.name.en).join(', ');
        document.getElementById('editTags').value = tags;
        console.log(tags);
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    document.getElementById('editForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const form = event.target;
        const formData = new FormData(form);
        const actionUrl = form.action;

        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Offer updated successfully!');
                closeEditModal();
                location.reload(); // Reload the page to reflect changes
            } else {
                alert('Failed to update the offer. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
</script>

@endsection
