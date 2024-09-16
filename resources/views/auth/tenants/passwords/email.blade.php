<x-tenant-app-layout>
    <main class="flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 border border-gray-300 rounded-lg shadow-lg" data-aos="fade-up">
            <h2 class="text-2xl font-semibold text-gray-700 text-center">
                Forgot Your Password?
            </h2>
            <p class="text-gray-500 text-center">
                Enter your email address and we'll send you a link to reset your password.
            </p>

            <!-- Success Message -->
            @if (session('status'))
                <div class="bg-green-100 text-green-800 border border-green-300 rounded-lg p-4 mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 border border-red-300 rounded-lg p-4 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <x-tenants.form.label for="email">
                        Email Address:
                    </x-tenants.form.label>
                    <x-tenants.form.input
                        type="email"
                        name="email"
                        value="{{old('email')}}"
                        id="email"
                        placeholder="Enter your email"
                        autofill="email"
                        autoselect
                        required
                        class="w-full"
                    />
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="w-full bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 transition duration-300 ease-in-out"
                    >
                        Send Password Reset Link
                    </button>
                </div>

                <!-- Back to Login Link -->
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </main>
</x-tenant-app-layout>