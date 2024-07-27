<x-app-layout>
    <x-landlord.content_wrapper :overlay="true" :bg="asset('storage/landlord_login_bg.png')" class="flex justify-end items-center h-full" style="
    background-size: cover;
    min-height: auto;
    padding:0;
    ">
    <main class="bg-black bg-opacity-50 w-full md:w-1/2 lg:w-1/3 py-20 px-9 h-full">

                    <form method="POST" action="{{ route('landlord.password.update') }}">
                        @csrf
                        <header class="mb-11 font-libre" style="font-size: 2rem">Reset Password</header>
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{$email}}">

                        @foreach($errors as $error)
                        <div>
                            {{$error->message}}
                        </div>
                        @endforeach
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
                        <x-landlord.form.button type="submit">
                            Reset Password
                        </x-landlord.form.button>
                    </form>

    </main>
    </x-landlord.content_wrapper>
</x-app-layout>
