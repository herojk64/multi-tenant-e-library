<x-tenant-app-layout>
    <main class="flex items-center justify-center bg-gray-100">
        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-8 w-full max-w-md" data-aos="flip-up">
            <h2 class="text-2xl font-semibold mb-6 text-center text-gray-700">Register</h2>
            <form method="post" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <!-- Name Field -->
                <x-tenants.form.wrapper>
                    <x-tenants.form.label for="name">
                        Name:
                    </x-tenants.form.label>
                    <x-tenants.form.input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        id="name"
                        placeholder="Enter your full name"
                        required
                        class="w-full"
                    />
                    <x-tenants.form.error name="name"/>
                </x-tenants.form.wrapper>
                <!-- Email Field -->
                <x-tenants.form.wrapper>
                    <x-tenants.form.label for="email">
                        Email:
                    </x-tenants.form.label>
                    <x-tenants.form.input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
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
                <!-- Confirm Password Field -->
                <x-tenants.form.wrapper>
                    <x-tenants.form.label for="password_confirmation">
                        Confirm Password:
                    </x-tenants.form.label>
                    <x-tenants.form.input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        autofill="password"
                        placeholder="Confirm your password"
                        class="w-full"
                    />
                    <x-tenants.form.error name="password_confirmation"/>
                </x-tenants.form.wrapper>
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 transition duration-300 ease-in-out">
                    Register
                </button>
                <!-- Additional Links -->
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </main>
</x-tenant-app-layout>
