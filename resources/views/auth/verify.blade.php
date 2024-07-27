<x-app-layout>

    <x-landlord.content_wrapper :overlay="true" :bg="asset('storage/landlord_login_bg.png')" class="flex justify-end items-center h-full" style="
    background-size: cover;
    min-height: auto;
    padding:0;
    ">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('landlord.password.email') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
    </x-landlord.content_wrapper>
</x-app-layout>
