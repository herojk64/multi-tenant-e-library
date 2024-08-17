<a
    {{
    $attributes->merge(
            [
            'class'=>"block cursor-pointer py-2 px-3 hover:border-b-gray-800 hover:border-b-2 hover:text-gray-800 transition delay-75 ease-in-out active:bg-gray-200 active:bg-opacity-75".
            " ".
            (url()->current() === $route?"text-gray-800 border-b-gray-800 border-b-2":"text-gray-500")
            ]
            )
            }}
    href="{{$route}}"
>
{{$slot}}
</a>
