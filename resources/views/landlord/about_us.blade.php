<x-landlord-app-layout>
    <main class="flex items-center justify-center bg-gray-100 py-8 px-4">
        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-8 max-w-4xl mx-auto" data-aos="fade-up">
            <!-- Application Info -->
            <article class="mb-8">
                <header class="text-3xl font-bold text-gray-700 mb-4">About {{ config('app.name') }}</header>
                <p class="text-gray-600 text-justify">
                    Welcome to {{ config('app.name') }} - your ultimate destination for a multi-tenant e-library solution. Our platform, {{config('app.name')}}, is designed to cater to various e-library needs with ease and efficiency. Whether you’re managing a small library or a large network of libraries, our application provides robust features to help you manage and grow your digital collection seamlessly.
                </p>
                <p class="text-gray-600 text-justify mt-4">
                    Our application is built to support a diverse range of e-library functionalities, offering a flexible and scalable solution. From user management and content organization to detailed analytics, **Tomb Wave** has everything you need to provide an exceptional digital library experience.
                </p>
            </article>

            <!-- Mission and Vision -->
            <article class="mb-8">
                <header class="text-2xl font-semibold text-gray-700 mb-4">Our Mission</header>
                <p class="text-gray-600 text-justify">
                    Our mission is to empower libraries with the tools they need to deliver an unparalleled digital experience. We strive to make e-library management intuitive and effective, fostering a culture of knowledge sharing and accessibility.
                </p>
                <header class="text-2xl font-semibold text-gray-700 mt-6 mb-4">Our Vision</header>
                <p class="text-gray-600 text-justify">
                    We envision a world where every library, regardless of its size, can harness the power of digital resources to enhance learning and information accessibility. {{config('app.name')}} aims to be at the forefront of this transformation, providing innovative solutions and exceptional support to our clients.
                </p>
            </article>

            <!-- Contact Information -->
            <address>
                <header class="text-2xl font-semibold text-gray-700 mb-4">Contact Us</header>
                <p class="text-gray-600 text-justify">
                    If you have any questions or need further information, please feel free to reach out to us at <a href="mailto:herojk64@gmail.com }}" class="text-blue-500 hover:underline">Support</a>. We're here to assist you with any inquiries or support needs you may have.
                </p>
            </address>
        </div>
    </main>
</x-landlord-app-layout>
