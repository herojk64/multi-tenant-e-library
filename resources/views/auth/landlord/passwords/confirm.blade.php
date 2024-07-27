<x-app-layout>

    <x-landlord.content_wrapper :overlay="true" :bg="asset('storage/landlord_login_bg.png')" class="flex justify-end items-center h-full" style="
    background-size: cover;
    min-height: auto;
    padding:0;
    ">
        <main class="bg-black bg-opacity-50 w-full md:w-1/2 lg:w-1/3 py-20 px-9 h-full">

                <div class="card-header">{{ __('Confirm Password') }}</div>

                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
        </main>
    </x-landlord.content_wrapper>
</x-app-layout>
