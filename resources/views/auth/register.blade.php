<x-app-layout>
        <x-landlord.content_wrapper :overlay="true" :bg="asset('storage/landlord_login_bg.png')" class="flex justify-end items-center h-full py-0" style="
    background-size: cover;
    min-height: auto;
    padding:0;
    ">
            <main class="bg-black bg-opacity-50 w-full md:w-1/2 lg:w-1/3 py-20 px-9 h-full">
                    <form method="POST" action="{{ route('landlord.register') }}">
                        @csrf
                        <header class="mb-11 font-libre" style="font-size: 2rem">Sign Up</header>


                        <div class="mb-14">
                            <x-landlord.form.input
                            type="text"
                            name="name"
                            id="name"
                            label="Full Name"
                            required
                            autofocus
                            />



                        </div>

                        <div class="mb-14">
                            <x-landlord.form.input
                                type="email"
                                name="email"
                                id="email"
                                label="Email Address"
                                required
                            />


                        </div>

                        <div class="mb-14">
                            <x-landlord.form.input
                                type="password"
                                name="password"
                                id="password"
                                label="Password"
                                required
                            />


                        </div>

                        <div class="mb-4">
                            <x-landlord.form.input
                                type="password"
                                name="password_confirmation"
                                id="password-confirm"
                                label="Confirm Password"
                                required
                            />
                        </div>

                        <p class="mb-6">
                           Already have an account? <a href="{{route('landlord.login')}}" class="italic font-light text-md underline">Login</a>
                        </p>

                        <x-landlord.form.button type="submit">
                            Sign Up
                        </x-landlord.form.button>

                    </form>
            </main>
        </x-landlord.content_wrapper>
</x-app-layout>
