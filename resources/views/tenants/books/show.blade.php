<x-tenant-app-layout>
    <section class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-6">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Book Image -->
            <div class="w-full lg:w-1/3">
                <img src="{{ asset('storage/'.$book->thumbnail) ?? asset('images/default-book.png') }}"
                     alt="{{ $book->title }}" class="w-full h-auto object-cover rounded-lg shadow-lg">
            </div>

            <!-- Book Details -->
            <div class="w-full lg:w-2/3">
                <h1 class="text-4xl font-semibold mb-4 text-gray-800">{{ $book->title }}</h1>
                <p class="text-xl text-gray-600 mb-4">by {{ $book->author_name }}</p>
                <p class="text-md text-gray-600 mb-4">Rating: {{$book->bayesianRating()}}</p>
                <p class="text-gray-800 mb-6">{{ $book->description }}</p>

                @can('view-content', $book)

                @endcan


                <div class="flex gap-4">
                    <a href="{{ route('books') }}" class="text-indigo-600 hover:text-indigo-800 transition">Back to Books</a>
                </div>
            </div>
        </div>

        <!-- PDF Section -->
        <div class="mt-8">
            @can('view-content', $book)
                @if($url)
                    <div class="flex justify-between items-center mb-6">
                        <!-- Heading Section -->
                        <h2 class="text-2xl font-semibold text-gray-800">Read the Book</h2>

                        <!-- Rating Section -->
                        <div class="flex flex-col items-center">
                            <p class="text-lg font-medium text-gray-600 mb-2">
                                Rate the book
                            </p>
                            <div class="flex">
                                <!-- Inject the Livewire Component for Rating -->
                                @livewire('tenants.rate-book', ['book' => $book])
                            </div>
                        </div>
                    </div>

                    <div id="pspdfkit-container" data-url="{{ $url }}" style="width: 100%; height: 600px;"></div>
                @else
                    <p class="text-gray-500">No PDF available for this book.</p>
                @endif
            @else
                <p class="text-gray-500">
                    You do not have access to read this book.
                    @if(auth()->check())
                    Please check your subscription status.
                    @else
                        @if($book->type === \App\Enum\BookType::FREE)
                        Please login to access this feature.
                            @else
                            Please login to access this book if you have the subscription.
                            @endif
                    @endif
                </p>
            @endcan
        </div>
    </section>

    @can('view-content', $book)
        @if($url)
            @push('js')
                <script src="https://unpkg.com/pspdfkit@latest/dist/pspdfkit.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const container = document.getElementById('pspdfkit-container');
                        const url = container.dataset.url;

                        // Set the base URL for PSPDFKit assets if needed
                        const baseUrl = `${window.location.protocol}//${window.location.host}/assets/`;

                        PSPDFKit.load({
                            container: container,
                            document: url,
                            baseUrl: baseUrl
                        }).then(function (instance) {
                            console.log('PSPDFKit loaded', instance);

                            // Customize toolbar and view state
                            instance.setViewState((state) => {
                                return state
                                    .set("allowPrinting", false)    // Disable printing
                                    .set("allowDownloading", false) // Disable downloading
                                    .set("allowAnnotations", false) // Disable annotations
                                    .set("allowSharing", false);    // Disable sharing
                            });

                            // Customize toolbar to include only essential items
                            const toolbarItems = PSPDFKit.defaultToolbarItems;

                            // Keep only page navigation, zoom, fit page, and thumbnail items
                            const essentialToolbarItems = toolbarItems.filter(item =>
                                ["pager", "zoom-in", "zoom-out", "fit", "thumbnails", "pan"].includes(item.type)
                            );

                            instance.setToolbarItems(essentialToolbarItems);

                        }).catch(function (error) {
                            console.error('Error loading PSPDFKit', error);
                        });
                    });
                </script>
            @endpush
        @endif
    @endcan
</x-tenant-app-layout>
