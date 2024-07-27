@if(Route::has($link['url']))
    <a
        class="hover:font-bold {{$class ?? ''}}"
         href="{{route($link['url'])}}">
  {{$slot}}
</a>
@else
    <a class="hover:font-bold {{$class ?? ''}}" href="{{route('landlord.home')}}/#{{$link['url']}}">
        {{$slot}}
    </a>
@endif
