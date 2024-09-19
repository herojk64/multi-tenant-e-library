@php use Illuminate\Support\Str; @endphp
<header x-data="{ open: false }" x-init="open = false"
        class="flex items-center justify-between px-3 mb-4 py-3 border-b border-b-gray-300 bg-white">
    <h1 class="font-bold text-2xl md:text-3xl text-gray-500 delay-100">
        <a href="{{route('home')}}" class="">
            {{ Str::headline(config('app.name')) }}
        </a>
    </h1>

    <!-- Toggle Button for Mobile View -->
    <button @click="open = !open" class="md:hidden p-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Navigation Menu -->
    <nav class="hidden md:flex md:gap-3">
        <ul class="flex gap-3">
            <li>
                <x-tenants.partials._navlink :route="route('home')">Home</x-tenants.partials._navlink>
            </li>
            <li>
                <x-tenants.partials._navlink :route="route('services')">Services</x-tenants.partials._navlink>
            </li>
            <li>
                <x-tenants.partials._navlink :route="route('books')">Books</x-tenants.partials._navlink>
            </li>
            @guest
                <li>
                    <button class="">
                        <a href="{{route('login')}}" class="block border border-blue-500 hover:border-blue-600
                        w-full bg-blue-500 text-white rounded px-6 py-2 hover:bg-blue-600 transition duration-300 ease-in-out
                        ">
                            Login
                        </a>
                    </button>
                </li>
                <li>
                    <button class="">
                        <a href="{{route('register')}}" class="block border border-blue-500 hover:border-blue-600
                        w-full bg-transparent text-gray-500 hover:text-gray-800 rounded px-6 py-2 hover:bg-gray-100 transition duration-300 ease-in-out
                        ">
                            Sign Up
                        </a>
                    </button>
                </li>
            @endguest
            @auth
                <li x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" class="relative p-2">
                        <x-heroicon-o-cog-6-tooth class="h-6 w-6 hover:transform hover:rotate-90 transition delay-100 ease-in-out mt-1"/>
                    </button>
                    <div x-cloak x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-lg overflow-hidden z-20">
                        <ul>
                            @can('admin')
                                <li><a href="{{route('filament.admins.pages.dashboard')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-center">Admin Dashboard</a></li>
                            @endcan
                            <li><a href="{{route('profile')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-center">Profile</a></li>
                            <li><a href="{{route('dashboard')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-center">Dashboard</a></li>
                            <li>
                                <form action="{{route('logout')}}" method="post" class="w-full">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-gray-700 hover:bg-red-600 hover:text-white">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            @endauth
        </ul>
    </nav>

    <!-- Off-Canvas Menu for Mobile View -->
    <div x-show="open" x-cloak @click.away="open = false" class="fixed inset-0 z-50">
        <!-- Overlay -->
        <div
            x-show="open"
            x-transition:enter="transition-opacity duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-50"
            x-transition:leave="transition-opacity duration-300"
            x-transition:leave-start="opacity-50"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-800 bg-opacity-50"
        ></div>

        <!-- Off-Canvas Content -->
        <div
            x-show="open"
            x-transition:enter="transition-transform duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-y-0 right-0 bg-white shadow-lg w-64 transform"
        >
            <button @click="open = false" class="absolute top-4 right-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Navigation Links with Sequential Animation -->
            <div class="flex flex-col h-screen items-center justify-center  px-4 space-y-3">
                <ul class="w-full space-y-6">
                    <li class="w-full">
                        <x-landlord.partials._navlink
                            :route="route('home')"
                            class="text-center w-full hover:border-b-transparent border-0 bg-gray-50 active:border-b-transparent active:bg-gray-300 active:text-gray-800 rounded border-b-transparent"
                        >Home
                        </x-landlord.partials._navlink>
                    </li>
                    <li>
                        <x-landlord.partials._navlink
                            :route="route('books')"
                            class="text-center w-full hover:border-b-transparent border-0 bg-gray-50 active:border-b-transparent active:bg-gray-300 active:text-gray-800 rounded border-b-transparent"
                        >Books
                        </x-landlord.partials._navlink>
                    </li>
                    @guest
                        <li>
                            <x-landlord.partials._navlink
                                :route="route('login')"
                                class="w-full text-center border-0 hover:border-b-transparent active:border-b-transparent border-b-transparent text-white bg-blue-500 rounded active:text-white active:bg-blue-500 hover:text-white hover:border-b-0"
                            >Login
                            </x-landlord.partials._navlink>
                        </li>
                        <li>
                            <x-landlord.partials._navlink
                                :route="route('register')"
                                class="w-full text-center hover:border-b-blue-500 hover:border-b-1 hover:text-blue-500 transition delay-100 ease-in-out border border-blue-500 active:border-blue-300 active:bg-white hover:border-b-1 active:text-blue-300 rounded text-blue-500"
                            >Sign Up
                            </x-landlord.partials._navlink>
                        </li>
                    @endguest
                    @auth
                        <li x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" class="text-center w-full hover:border-b-transparent border-0 bg-gray-50 active:border-b-transparent active:bg-gray-300 active:text-gray-800 rounded border-b-transparent py-2">
                                Settings
                            </button>
                            <div x-cloak x-show="dropdownOpen" @click.away="dropdownOpen = false" class="mt-2 w-full bg-gray-100 border border-gray-100">
                                <ul class="space-y-4">
                                    @can('landlord.admin')
                                        <li><a href="{{route('filament.admin.pages.dashboard')}}" class="block px-4 py-2 bg-white text-center active:bg-gray-100">Admin Dashboard</a></li>
                                    @endcan
                                    <li><a href="{{route('profile')}}" class="block px-4 py-2 bg-white text-center active:bg-gray-100">Profile</a></li>
                                    <li><a href="{{route('dashboard')}}" class="block px-4 py-2 bg-white text-center active:bg-gray-100">Dashboard</a></li>
                                    <li>
                                        <form action="{{route('logout')}}" method="post" class="w-full">
                                            @csrf
                                            <button type="submit" class="block w-full px-4 py-2 text-white bg-red-500">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>
