<x-tenant-app-layout>
    <main class="flex items-center justify-center bg-gray-100">
        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-8 w-full max-w-md" data-aos="flip-up">
            <h2 class="text-2xl font-semibold mb-6 text-center text-gray-700">Login</h2>
            @if (session('success'))
                <div class="bg-green-100 text-green-800 border border-green-300 rounded-lg p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <form method="post" action="{{route('login')}}" class="space-y-6">
                @csrf
                <!-- Email Field -->
                <x-tenants.form.wrapper>
                    <x-tenants.form.label for="email">
                        Email:
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
                    <x-tenants.form.error name="email"/>
                </x-tenants.form.wrapper>
                <!-- Password Field -->
                <x-tenants.form.wrapper>
                    <x-tenants.form.label for="password">
                        Password:
                    </x-tenants.form.label>
                    <x-tenants.form.input
                        type="password"
                        name="password"
                        id="password"
                        autofill="password"
                        placeholder="Enter your password"
                        class="w-full"
                    />
                    <x-tenants.form.error name="password"/>
                </x-tenants.form.wrapper>
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 transition duration-300 ease-in-out">
                    Login
                </button>
                <!-- Forgot Password Link -->
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Forgot your password?</a>
                </div>
                <!-- Additional Links -->
                <div class="text-center mt-5">
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Don't have an account? Sign Up</a>
                </div>
            </form>
        </div>
    </main>
</x-tenant-app-layout>
