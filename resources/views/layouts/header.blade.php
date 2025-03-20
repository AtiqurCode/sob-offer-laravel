<header>
    <nav class="bg-white dark:bg-gray-800 shadow-lg fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center">
                    <img class="h-8 w-auto" src="https://tailwindflex.com/images/logo.svg" alt="Logo">
                    <span class="ml-2 text-xl font-bold text-gray-800 dark:text-gray-200">SobOffer</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:space-x-8">
                    <a href="#" class="border-indigo-500 text-gray-900 dark:text-gray-200 px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
                    <a href="#" class="border-transparent text-gray-500 dark:text-gray-400 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-300 px-1 pt-1 border-b-2 text-sm font-medium">Privacy</a>
                </div>

                <!-- Search & Mobile Menu Button -->
                <div class="flex items-center space-x-4">
                    <!-- Dark Mode Toggle -->
                    {{-- <button @click="darkMode = !darkMode" class="p-2 rounded-md text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Toggle dark mode</span>
                        <svg x-show="!darkMode" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.485-8.485h-1M4.515 12H3m15.364 4.95l-.707-.707M6.343 6.343l-.707-.707m12.728 12.728l-.707-.707M6.343 17.657l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                        </svg>
                        <svg x-show="darkMode" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.485-8.485h-1M4.515 12H3m15.364 4.95l-.707-.707M6.343 6.343l-.707-.707m12.728 12.728l-.707-.707M6.343 17.657l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                        </svg>
                    </button> --}}

                    <!-- Search Input (Hidden on Mobile) -->
                    <div class="hidden md:block relative text-gray-400 focus-within:text-gray-500">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <input id="search" class="block w-48 rounded-md border border-gray-300 bg-white dark:bg-gray-700 py-2 pl-10 pr-3 leading-5 text-gray-900 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 sm:text-sm" placeholder="Search" type="search">
                    </div>

                    <!-- Mobile Menu Button -->
                    <button aria-expanded="false" class="md:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="pt-2 pb-3 space-y-1">
                <a href="#" class="block px-3 py-2 border-l-4 border-indigo-500 bg-indigo-50 dark:bg-gray-700 dark:border-gray-600 text-indigo-700 dark:text-gray-200 text-base font-medium">Home</a>
                <a href="#" class="block px-3 py-2 border-l-4 border-transparent hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 text-gray-700 dark:text-gray-200 text-base font-medium">Privacy</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700 flex items-center px-4">
                <div class="w-full relative text-gray-400 focus-within:text-gray-500">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input id="mobile-search" class="block w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 py-2 pl-10 pr-3 leading-5 text-gray-900 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 sm:text-sm" placeholder="Search" type="search">
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    // Simple toggle for mobile menu
    document.querySelector('button[aria-expanded]').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
        mobileMenu.classList.toggle('hidden');
    });
</script>
