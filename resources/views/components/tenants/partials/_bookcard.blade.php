<!-- resources/views/partials/_bookcard.blade.php -->
<a href="{{route('books.show',$book)}}" class="block bg-white shadow-md rounded-lg overflow-hidden relative no-underline hover:no-underline group">
    <div class="relative overflow-hidden h-56">
        <img src="{{ asset('storage/'.$book->thumbnail) ?? asset('images/default-book.png') }}" loading="lazy" alt="{{ $book->title }}" class="w-full h-56 object-cover transition-transform duration-300 transform hover:absolute hover:scale-110">
    </div>
    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800 truncate">{{ $book->title }}</h2>
        @if($book->author_name)
            <p class="text-gray-600 mt-2 text-sm">by {{ $book->author_name }}</p>
        @endif
        <p class="text-sm text-gray-600 mt-2">Rating: {{$book->averageRating()}}</p>
        @if($book->category)
            <p class="text-gray-500 mt-2 text-sm">
                Category: {{ $book->category->name }}
            </p>
        @endif
        <p class="text-gray-500 mt-2 text-sm mb-3 truncate">
            {{ Str::limit($book->description, 100) }}
        </p>
        <button class="mt-4 bg-blue-500 w-full text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            View Details
        </button>
    </div>

    <!-- Badge for book type -->
    <div class="absolute top-2 right-2 bg-gray-800 text-white text-xs font-semibold py-1 px-3 rounded-full">
        {{ ucfirst($book->type->value) }}
    </div>
</a>
