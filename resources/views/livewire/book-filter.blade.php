<div x-data="{ open: false }" class="relative lg:flex lg:flex-row">
    <!-- Toggle Button for Mobile -->
    <button
        @click="open = !open"
        x-text="open ? 'Hide Filter' : 'Show Filter'"
        class="mb-4 lg:hidden p-2 text-white bg-indigo-600 block ms-4 focus:outline-none hover:bg-indigo-700 transition duration-300 ease-in-out"
    ></button>

    <!-- Sidebar -->
    <aside
        :class="{ 'hidden lg:block': !open }"
        class="lg:w-1/4 w-full bg-gray-100 p-6 lg:border-r lg:border-gray-300"
    >
        <input
            type="text"
            wire:model.lazy="search"
            placeholder="Search books..."
            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out mb-6"
        />
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Filter by Category</h2>
        <form class="lg:block flex gap-2 flex-wrap">
            @foreach($categories as $category)
                <div class="mb-3 flex items-center">
                    <input
                        type="checkbox"
                        id="category-{{ $category->id }}"
                        wire:change="filterByCategory({{ $category->id }})"
                        class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out"
                        @if(in_array($category->id, $selectedCategories)) checked @endif
                    >
                    <label for="category-{{ $category->id }}" class="ml-2 text-gray-700 text-base">{{ $category->name }}</label>
                </div>
            @endforeach
        </form>
    </aside>

    <!-- Main Content -->
    <main class="lg:w-3/4 w-full p-6 bg-white">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Books</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($books as $book)
                <x-tenants.partials._bookcard :book="$book" />
            @empty
                <p class="text-gray-500 text-lg">No books found.</p>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $books->links('pagination::tailwind') }}
        </div>
    </main>
</div>
