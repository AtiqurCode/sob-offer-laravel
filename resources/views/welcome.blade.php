@extends('layouts.app')

@section('content')
        {{-- main content --}}
        <div class="pt-8">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="px-4 py-6 sm:px-0">
                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 p-3 md:p-4 xl:p-5 dark:bg-gray-900">
                        @foreach ($offers as $offer)
                             <x-card :offer="$offer" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
