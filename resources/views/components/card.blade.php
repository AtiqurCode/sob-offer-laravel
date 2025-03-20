<?php
$media = $offer->getFirstMedia('featured_image');

$imageUrl = $media
    ? ($media->hasGeneratedConversion('thumb')
        ? $media->getUrl('thumb')
        : $media->getUrl())
    : asset('/images/default-image.jpg'); // Optional fallback image
?>

<div class="bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    <div class="p-2 flex justify-center">
        <a href="{{ $offer['link'] }}">
            <img class="rounded-lg" src="{{ $imageUrl }}" alt="{{ $offer['alt'] }}" loading="lazy">
        </a>
    </div>
    <div class="px-4 pb-3">
        <div>
            <a href="{{ route('offers.show', $offer->uuid) }}?title={{ urlencode($offer->title) }}" class="block">
                <h5
                    class="text-xl font-semibold tracking-tight hover:text-violet-800 dark:hover:text-violet-300 text-gray-900 dark:text-white">
                    {{ $offer['title'] }}
                </h5>
            </a>
            {{-- <p class="text-gray-600 dark:text-gray-400 text-sm break-all">{{ $offer['description'] }}</p> --}}
        </div>
    </div>

    <div class="mt-0 flex justify-between">
        <div class="flex items-center mt-1 mb-1">
            <p class="text-gray-600 dark:text-gray-300 hover:text-violet-800">

                <span id="countdown-{{ $offer['id'] }}"
                    class="bg-red-400 text-gray-100 text-2xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-400 dark:text-gray-100 ml-3"></span>
                <span
                    class="bg-blue-100 text-blue-800 text-2xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-1">
                    {{ $offer->category->name }}
                </span>
            </p>

        </div>
    </div>


    {{-- <div class="mt-2 flex justify-between">
        <div class="flex gap-3 py-2">
            <a href="{{ $offer['author_link'] }}">
                <img src="{{ $offer['author_image'] }}" class="object-cover w-12 h-12 rounded-full"
                    alt="{{ $offer['author_name'] }}" loading="lazy">
            </a>
            <p class="text-gray-600 dark:text-gray-300 hover:text-violet-800">
                <a href="{{ $offer['author_link'] }}" class="text-sm">
                    <small>Author:</small> <br>
                    {{ $offer['author_name'] }}
                </a>
            </p>
        </div>
        <div class="flex items-center mt-2.5">
            <span class="text-sm dark:text-gray-400">Ratings</span>
            <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">
                {{ $offer['rating'] }}
            </span>
        </div>
    </div> --}}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const endDate = new Date("{{ $offer['end_date'] }}").getTime();
        const countdownElement = document.getElementById('countdown-{{ $offer['id'] }}');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = endDate - now;

            if (distance < 0) {
                countdownElement.innerHTML = "Expired";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }

        setInterval(updateCountdown, 1000);
    });
</script>
