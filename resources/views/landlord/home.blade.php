<x-landlord-app-layout>
    <main class="bg-gray-100">
        <!-- Hero Section -->
        <section class="bg-white shadow-lg p-8 mb-8 w-full flex flex-col items-center justify-center min-h-[70vh] bg-[url('../assets/landlord_home_image_1.png')] bg-fixed">
            <header class="text-4xl text-white font-bold mb-4">
                Welcome to {{ config('app.name') }}
            </header>
            <p class="text-white text-lg mb-6">
                Your go-to solution for a multi-tenant e-library. Transform how you manage and share knowledge with our powerful and scalable platform.
            </p>
            @guest
            <a href="{{ route('landlord.register') }}" class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 transition duration-300 ease-in-out">
                Get Started
            </a>
                @endguest
                @auth
                        <a href="{{ route('landlord.services') }}" class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 transition duration-300 ease-in-out">
                            Services
                        </a>
                @endauth
        </section>

        <!-- Features Section -->
        <section class="max-w-4xl mx-auto mb-8" data-aos="fade-up">
            <header class="text-3xl font-semibold text-gray-700 mb-6 text-center">
                Key Features
            </header>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <article class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 text-center" data-aos="flip-left">
                    <!-- SVG Icon -->
                    <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4.8l2.8 1.6V7.6L12 6v2zM6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <header class="text-xl font-semibold text-gray-700 mb-2">Comprehensive Catalog Management</header>
                    <p class="text-gray-600">
                        Efficiently manage and categorize your digital collection with ease, providing users with a seamless browsing experience.
                    </p>
                </article>
                <!-- Feature 2 -->
                <article class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 text-center" data-aos="flip-left" data-aos-delay="200">
                    <!-- SVG Icon -->
                    <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 8h14M5 16h14"></path>
                    </svg>
                    <header class="text-xl font-semibold text-gray-700 mb-2">Multi-Tenant Support</header>
                    <p class="text-gray-600">
                        Our platform supports multiple libraries, allowing for individual management while providing a unified interface.
                    </p>
                </article>
                <!-- Feature 3 -->
                <article class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 text-center" data-aos="flip-left" data-aos-delay="300">
                    <!-- SVG Icon -->
                    <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4.8l2.8 1.6V7.6L12 6v2zM6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <header class="text-xl font-semibold text-gray-700 mb-2">Advanced Analytics</header>
                    <p class="text-gray-600">
                        Gain valuable insights into user interactions and library usage with our advanced analytics tools.
                    </p>
                </article>
            </div>
        </section>

        <!-- Features Section -->
        <section class="bg-white border border-gray-300 rounded-lg shadow-lg p-8 max-w-4xl mx-auto mb-8" data-aos="fade-up">
            <header class="text-3xl font-semibold text-gray-700 mb-6 text-center">
                Why You'll Love Us
            </header>
            <div class="flex flex-col space-y-6">
                <!-- Feature 1 -->
                <div class="bg-gray-50 border border-gray-300 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Seamless Integration</h3>
                    <p class="text-gray-600 mt-2">Our platform integrates smoothly with your existing systems, making transitions effortless.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-gray-50 border border-gray-300 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800">User-Friendly Interface</h3>
                    <p class="text-gray-600 mt-2">Enjoy an intuitive and easy-to-navigate interface designed for both tech-savvy and non-technical users.</p>
                </div>
            </div>
        </section>


        <!-- Call to Action Section -->
        <section class="bg-blue-500 text-white text-center py-8 px-4 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="500">
            <header class="text-3xl font-bold mb-4">
                Ready to Transform Your Library?
            </header>
            <p class="mb-6">
                Join the thousands of libraries that have revolutionized their digital collections with {{ config('app.name') }}.
            </p>
            @guest
            <a href="{{ route('landlord.register') }}" class="bg-white text-blue-500 rounded-lg px-4 py-2 hover:bg-gray-200 transition duration-300 ease-in-out">
                Sign Up Now
            </a>
            @endguest
            @auth
                <a href="{{ route('landlord.services') }}" class="bg-white text-blue-500 rounded-lg px-4 py-2 hover:bg-gray-200 transition duration-300 ease-in-out">
                    Apply for service
                </a>
                @endauth
        </section>
    </main>
</x-landlord-app-layout>
