<button
    type="{{$type ?? 'button'}}"
    {{$attributes->merge(['class'=>'w-full bg-secondary text-white py-2 text-center text-light-1'])}}
>
{{$slot}}
</button>
