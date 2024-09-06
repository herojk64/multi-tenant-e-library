<!-- resources/views/tenants/index.blade.php -->
<x-tenant-app-layout>
    <main class="bg-gray-100">
        <!-- Page Title -->
        <section class="bg-white shadow-lg p-8 mb-12 w-full flex flex-col items-center justify-center min-h-[60vh] bg-[url('../assets/landlord_home_image_1.png')] bg-fixed bg-cover bg-center">
            <h1 class="text-4xl text-white font-bold mb-4">Welcome to Our E-Library</h1>
            <p class="text-white text-lg mb-6">Discover and explore a wide range of books.</p>
        </section>

        <!-- Recommended Books Section -->
        <section class="my-12 px-6 lg:px-12">
            <h2 class="text-4xl font-semibold text-gray-800 text-center mb-6">Recommended Books</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($recommendedBooks as $book)
                    <x-tenants.partials._bookcard :book="$book"/>
                @endforeach
            </div>
        </section>

        <!-- Features Section -->
        <section class=" shadow-lg p-8 mb-12 w-full flex flex-col items-center justify-center min-h-[60vh] bg-[url('../assets/landlord_home_image_1.png')] bg-fixed bg-cover bg-center">
            <x-tenants.partials._features />
        </section>

        <section>
            <h2 class="text-4xl font-semibold text-gray-800 text-center mb-6">Some Books</h2>
            @php
                $bookGroups = $books->chunk(5);
            @endphp
            <x-tenants.partials._slider>
                @foreach($bookGroups as $group)
                    <div class="flex space-x-4">
                        @foreach($group as $book)
                            <div class="w-60">
                                <x-tenants.partials._bookcard :book="$book"/>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </x-tenants.partials._slider>
            <div class="my-4 grid place-items-center">
                <a href="{{route('books')}}" class="mx-auto text-center cursor-pointer delay-75 transition ease-in-out text-blue-500 hover:text-blue-700 px-4 py-2 border border-blue-500 hover:border-blue-700">See more</a>
            </div>
        </section>

    </main>
</x-tenant-app-layout>
