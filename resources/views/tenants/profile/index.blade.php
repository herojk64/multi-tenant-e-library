<x-tenant-app-layout>
    <div class="grid grid-cols-[auto_1fr] gap-2 mx-2">
        <x-tenants.partials._sidenavbar />

        <!-- Main Content -->
        <main class="p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Profile Overview</h1>

            <!-- Profile Details -->
            <div class="border border-gray-300 p-6 rounded mb-6">
                <h2 class="text-xl font-semibold mb-2">Personal Information</h2>
                <p class="mb-2">Name: {{ auth()->user()->name }}</p>
                <p class="mb-2">Email: {{ auth()->user()->email }}</p>
                <p class="mb-2">Joined: {{ auth()->user()->created_at->format('F j, Y') }}</p>
                <!-- Add more personal details as needed -->
            </div>

            <!-- Change Password Section -->
            <div class="border border-gray-300 p-6 rounded mb-6">
                <h2 class="text-xl font-semibold mb-4 text-center">Change Password</h2>


                <!-- Password Change Form -->
                <form action="{{ route('profile.update-password') }}" method="POST" class="w-full md:w-1/2 mx-auto">
                    @csrf
                    @method('PUT')

                    <x-tenants.form.wrapper>
                        <x-tenants.form.label for="current_password">Current Password</x-tenants.form.label>
                        <x-tenants.form.input type="password" name="current_password" id="current_password" class="w-full" required />
                        <x-tenants.form.error name="current_password"/>
                    </x-tenants.form.wrapper>

                    <x-tenants.form.wrapper class="mb-4">
                        <x-tenants.form.label for="password">New Password</x-tenants.form.label>
                        <x-tenants.form.input type="password" name="password" id="password" class="w-full" required />
                        <x-tenants.form.error name="password"/>
                    </x-tenants.form.wrapper>

                    <x-tenants.form.wrapper class="mb-4">
                        <x-tenants.form.label for="password_confirmation">Confirm New Password</x-tenants.form.label>
                        <x-tenants.form.input type="password" name="password_confirmation" id="password_confirmation" class="w-full" required />
                        <x-tenants.form.error name="password_confirmation"/>
                    </x-tenants.form.wrapper>

                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                        Update Password
                    </button>
                </form>
            </div>
        </main>
    </div>
</x-tenant-app-layout>
