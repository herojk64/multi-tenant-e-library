@php
    use \Illuminate\Support\Str;
@endphp
<nav class="text-light-1 flex py-2 mx-6 lg:px-14 px-4 md:px-8 border-b border-b-light-1 border-opacity-50 justify-between items-center">
    <a href="{{route('landlord.home')}}">
    @if($logo)
        <img src="{{ $logo }}" alt="logo"/>
    @else
        <h1 class="" style="font-size:2rem;">{{ Str::headline(config('app.name','Laravel')) }}</h1>
    @endif
    </a>
{{--    TODO: MAKE A RESPONSIVE SLIDER--}}
    <div
        class="block lg:hidden"
        x-data="{toggle:false}"
    >
        <button
            class="z-30 relative"
                x-on:click="toggle=!toggle"
        >
            <svg x-show="!toggle" class="w-6 h-6 z-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
            <svg x-show="toggle" class="w-6 h-6 z-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div
            x-show="toggle"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-full"
            class="fixed inset-0 z-20 flex items-center justify-end bg-primary bg-opacity-90"
            x-on:click.away="toggle=false"
        >
            <div class="w-9/12 md:w-1/2 lg:w-0 bg-primary h-screen py-4" @click.away="toggle = false">
            <ul class="flex flex-col gap-6 text-center items-center justify-center h-full" >
                @foreach(config('links.landlord') as $link)
                    @if($link['type'] === 'link')
                        <li>
                            <x-landlord.nav.link :link="$link" class="w-full block">
                                {{Str::headline($link['title'])}}
                            </x-landlord.nav.link>
                        </li>
                    @elseif($link['type']==='guest')
                        @guest
                            <li>
                                <x-landlord.nav.link :link="$link" class="w-full block">
                                    {{Str::headline($link['title'])}}
                                </x-landlord.nav.link>
                            </li>
                        @endguest
                    @elseif($link['type']=== 'auth')
                        @auth
                            <li>
                                <x-landlord.nav.link :link="$link" class="w-full block">
                                    {{Str::headline($link['title'])}}
                                </x-landlord.nav.link>
                            </li>
                        @endauth
                    @elseif($link['type']==='logout')
                        @auth
                            <li>
                                <form method="POST" action="{{route($link['url'])}}" class="w-full block">
                                    @csrf
                                    <button type="submit" class="w-full block">
                                        {{Str::headline($link['title'])}}
                                    </button>
                                </form>
                            </li>
                        @endauth
                    @endif
                @endforeach
            </ul>
            </div>
        </div>
    </div>
    <ul class="hidden gap-6 lg:flex">
        @foreach(config('links.landlord') as $link)
            @if($link['type'] === 'link')
            <li>
                <x-landlord.nav.link :link="$link">
                    {{Str::headline($link['title'])}}
                </x-landlord.nav.link>
            </li>
            @elseif($link['type']==='guest')
                @guest
                    <li>
                        <x-landlord.nav.link :link="$link">
                            {{Str::headline($link['title'])}}
                        </x-landlord.nav.link>
                    </li>
                @endguest
            @elseif($link['type']=== 'auth')
                @auth
                    <li>
                        <x-landlord.nav.link :link="$link">
                            {{Str::headline($link['title'])}}
                        </x-landlord.nav.link>
                    </li>
                @endauth
            @elseif($link['type']==='logout')
                @auth
                <li>
                   <form method="POST" action="{{route($link['url'])}}">
                       @csrf
                       <button type="submit" class="">
                           {{Str::headline($link['title'])}}
                       </button>
                   </form>
                </li>
                    @endauth
            @endif
        @endforeach
    </ul>
</nav>
