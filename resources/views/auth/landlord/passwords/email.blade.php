<x-app-layout>
    <x-landlord.content_wrapper :overlay="true" :bg="asset('storage/landlord_login_bg.png')" class="flex justify-end items-center h-full" style="
    background-size: cover;
    min-height: auto;
    padding:0;
    ">
        <main class="bg-black bg-opacity-50 w-full md:w-1/2 lg:w-1/3 py-20 px-9 h-full">

            <header class="mb-11 font-libre" style="font-size: 2rem">
                {{ __('Reset Password') }}</header>


                    @if (session('status'))
                        <x-alertbox role="alert">
                            {{ session('status') }}
                        </x-alertbox>
                    @endif

                    <form method="POST" action="{{ route('landlord.password.request') }}">
                        @csrf

                        <div class="mb-3">
                            <x-landlord.form.input
                                label="Email Address"
                                type="email"
                                name="email"
                                class=""
                                autocomplete="email"
                                autofocus
                            />
                        </div>

                        <div class="mb-0">
                            <x-landlord.form.button type="submit">
                                Request
                            </x-landlord.form.button>
                        </div>
                    </form>
        </main>
    </x-landlord.content_wrapper>
</x-app-layout>
