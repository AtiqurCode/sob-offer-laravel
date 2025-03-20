<?php
$media = $offer->getFirstMedia('featured_image');

$imageUrl = $media
    ? $media->getUrl() : asset('/images/default-image.jpg'); // Optional fallback image
?>
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 mt-14">
    <div class="bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 flex justify-center">
            <img class="rounded-lg w-[900px] h-auto" src="{{ $imageUrl }}" alt="{{ $offer->title }}" loading="lazy">
        </div>
        <div class="px-6 py-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $offer->title }}</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-100">{!! $offer->description !!}</p>
        </div>
        <div class="px-6 py-4">
            <div class="text-center">
                <span id="countdown-{{ $offer->id }}" class="text-lg font-semibold bg-red-400 text-gray-100 px-4 py-2 rounded dark:bg-red-400 dark:text-gray-100"></span>
            </div>
        </div>
        <div class="px-6 py-4">
            <span class="bg-blue-300 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-blue-400 dark:text-blue-800">
                {{ $offer->category->name }}
            </span>
            @foreach($offer->tags as $tag)
            <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-2">
                {{ $tag->name }}
            </span>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const endDate = new Date("{{ $offer->end_date }}").getTime();
        const countdownElement = document.getElementById('countdown-{{ $offer->id }}');

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
@endsection
