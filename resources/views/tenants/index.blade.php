<!-- resources/views/services/index.blade.php -->
<x-tenant-app-layout>
    <main class="bg-gray-100">
        <!-- Page Title -->
        <section class="bg-white shadow-lg p-8 mb-12 w-full flex flex-col items-center justify-center min-h-[60vh] bg-[url('../assets/landlord_home_image_1.png')] bg-fixed bg-cover bg-center">
            <h1 class="text-4xl text-white font-bold mb-4">Welcome to Our E-Library</h1>
            <p class="text-white text-lg mb-6">Discover and explore a wide range of books.</p>
        </section>

        @if($popularBooks && $popularBooks->isNotEmpty())
            <!-- Popular Books Section -->
            <section class="my-12 px-6 lg:px-12">
                <h2 class="text-4xl font-semibold text-gray-800 text-center mb-6">Popular Books</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($popularBooks as $book)
                        <x-tenants.partials._bookcard :book="$book"/>
                    @endforeach
                </div>
            </section>
            <!-- Features Section -->
            <section class="shadow-lg p-8 mb-12 w-full flex flex-col items-center justify-center min-h-[60vh] bg-[url('../assets/tenant_home_image_2.jpg')] bg-fixed bg-cover bg-center">
                <h2 class="text-3xl text-white font-semibold mb-4">Why Choose Our E-Library?</h2>
                <p class="text-white text-lg text-center mb-4">Access a vast collection of books across various genres, curated to enhance your reading experience.</p>
                <ul class="text-white list-disc list-inside">
                    <li>📚 Extensive Collection: Over 10,000 titles available.</li>
                    <li>🔍 Advanced Search: Easily find the books you love.</li>
                    <li>💡 Personalized Recommendations: Discover books tailored to your interests.</li>
                </ul>
                <a href="{{ route('books') }}" class="mt-4 text-center cursor-pointer transition delay-75 ease-in-out text-blue-500 hover:text-blue-700 px-4 py-2 border border-blue-500 hover:border-blue-700">Start Exploring</a>
            </section>
        @endif

        @if($recomendedBooks && $recomendedBooks->isNotEmpty())
            <!-- Recommended Books Section -->
            <section class="my-12 px-6 lg:px-12">
                <h2 class="text-4xl font-semibold text-gray-800 text-center mb-6">Recommended Books</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($recomendedBooks as $book)
                        <x-tenants.partials._bookcard :book="$book"/>
                    @endforeach
                </div>
            </section>
            <section class="shadow-lg p-8 mb-12 w-full flex flex-col items-center justify-center min-h-[60vh] bg-[url('../assets/tenant_home_image_2.jpg')] bg-fixed bg-cover bg-center">
                <h2 class="text-3xl text-white font-semibold mb-4">Discover Your Next Favorite Book</h2>
                <p class="text-white text-lg text-center mb-4">Our recommendations are based on your reading history and preferences, ensuring you find the perfect read.</p>
                <a href="{{ route('books') }}" class="mt-4 text-center cursor-pointer transition delay-75 ease-in-out text-blue-500 hover:text-blue-700 px-4 py-2 border border-blue-500 hover:border-blue-700">View All Recommended Books</a>
            </section>
        @endif

        <!-- Top Rated Books Section -->
        <section class="my-12 px-6 lg:px-12">
            <h2 class="text-4xl font-semibold text-gray-800 text-center mb-6">Top Rated Books</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($topRatedBooks as $book)
                    <x-tenants.partials._bookcard :book="$book"/>
                @endforeach
            </div>
        </section>

        <!-- Features Section -->
        <section class="shadow-lg p-8 mb-12 w-full flex flex-col items-center justify-center min-h-[60vh] bg-[url('../assets/landlord_home_image_1.png')] bg-fixed bg-cover bg-center">
            <h2 class="text-3xl text-white font-semibold mb-4">Join Our Community of Readers</h2>
            <p class="text-white text-lg text-center mb-4">Connect with fellow book lovers and share your thoughts on your favorite reads.</p>
            <a href="{{ route('books') }}" class="mt-4 text-center cursor-pointer transition delay-75 ease-in-out text-blue-500 hover:text-blue-700 px-4 py-2 border border-blue-500 hover:border-blue-700">Get Involved</a>
        </section>

        <!-- Some Books Section -->
        <section>
            <h2 class="text-4xl font-semibold text-gray-800 text-center mb-6">Some Books</h2>
            @php
                $bookGroups = $books->chunk(5);
            @endphp
            <x-tenants.partials._slider>
                @foreach($bookGroups as $group)
                    <div class="flex space-x-4 gap-2">
                        @foreach($group as $book)
                            <div class="flex-1 w-60">
                                <x-tenants.partials._bookcard :book="$book"/>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </x-tenants.partials._slider>
            <div class="my-4 grid place-items-center">
                <a href="{{ route('books') }}" class="mx-auto text-center cursor-pointer transition delay-75 ease-in-out text-blue-500 hover:text-blue-700 px-4 py-2 border border-blue-500 hover:border-blue-700">See more</a>
            </div>
        </section>
    </main>
</x-tenant-app-layout>
