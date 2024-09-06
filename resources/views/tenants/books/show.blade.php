<x-tenant-app-layout>
    <section class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-6">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Book Image -->
            <div class="w-full lg:w-1/3">
                <img src="{{ $book->thumbnail ?? asset('images/default-book.png') }}" alt="{{ $book->title }}" class="w-full h-auto object-cover rounded-lg shadow-lg">
            </div>

            <!-- Book Details -->
            <div class="w-full lg:w-2/3">
                <h1 class="text-4xl font-semibold mb-4 text-gray-800">{{ $book->title }}</h1>
                <p class="text-xl text-gray-600 mb-4">by {{ $book->author }}</p>
                <p class="text-gray-800 mb-6">{{ $book->description }}</p>

                <div class="flex gap-4">
                    <a href="{{ route('books') }}" class="text-indigo-600 hover:text-indigo-800 transition">Back to Books</a>
                    <!-- Add more buttons or links as needed -->
                </div>
            </div>
        </div>
        <!-- PDF Section -->
        <div class="mt-8">
            @if($url)
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Read the Book</h2>
                <div class="w-full h-[600px]">
                    <iframe
                        src="{{ route('books.loadPdf', $book->id) }}"
                        width="100%"
                        height="100%"
                        class="rounded-lg shadow-lg"
                        sandbox="allow-scripts allow-same-origin"
                        frameborder="0"
                    >
                        Your browser does not support iframes.
                    </iframe>
                </div>
            @else
                <p class="text-gray-500">No PDF available for this book.</p>
            @endif
        </div>
    </section>
</x-tenant-app-layout>
