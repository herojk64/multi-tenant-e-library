<x-app-layout>
    <x-landlord.content_wrapper :overlay="true" :bg="asset('storage/landlord_login_bg.png')" class="flex justify-end items-center h-full" style="
    background-size: cover;
    min-height: auto;
    padding:0;
    ">
<main class="bg-black bg-opacity-50 w-full md:w-1/2 lg:w-1/3 py-20 px-9 h-full">
                    <form method="POST" action="{{ route('landlord.login') }}">
                        @csrf
                        <header class="mb-11 font-libre" style="font-size: 2rem">Login</header>

                        <div class="mb-14">
                            <x-landlord.form.input
                            label="Email"
                            type="email"
                            name="email"
                            class=""
                            autocomplete="email"
                            autofocus
                            />



                        </div>

                        <div class="row mb-14">
                            <x-landlord.form.input
                                label="Password"
                                type="password"
                                name="password"
                                autocomplete="current-password"
                            />
                        </div>

                        <div class="mb-6 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                            <x-landlord.form.input
                                label="Remember Me"
                                type="checkbox"
                                name="remember"
                                id="remember"
                            />
                            </div>
                            @if (Route::has('landlord.password.request'))
                            <a href="{{route('landlord.password.request')}}" class="text-sm font-light italic underline">
                                Forget Password
                            </a>
                            @endif

                        </div>
                                <x-landlord.form.button type="submit">
                                    Login
                                </x-landlord.form.button>
                    </form>
        </main>
    </x-landlord.content_wrapper>
</x-app-layout>
