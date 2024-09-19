@push('styles')
        <style>
            .hvr-underline-from-center-active {
                display: inline-block;
                vertical-align: middle;
                -webkit-transform: perspective(1px) translateZ(0);
                transform: perspective(1px) translateZ(0);
                box-shadow: 0 0 1px rgba(0, 0, 0, 0);
                position: relative;
                overflow: hidden;
            }
            .hvr-underline-from-center-active:before {
                content: "";
                position: absolute;
                z-index: -1;
                left: 51%;
                right: 51%;
                bottom: 0;
                background: #2098D1;
                height: 4px;
                -webkit-transition-property: left, right;
                transition-property: left, right;
                -webkit-transition-duration: 0.3s;
                transition-duration: 0.3s;
                -webkit-transition-timing-function: ease-out;
                transition-timing-function: ease-out;
            }
            .hvr-underline-from-center-active:before, .hvr-underline-from-center-active:before {
                left: 0;
                right: 0;
            }
        </style>
@endpush
<a
    {{
    $attributes->merge(
            [
            'class'=>"block cursor-pointer py-2 px-3 hover:text-gray-800 hvr-underline-from-center transition delay-75 ease-in-out active:bg-gray-200 active:bg-opacity-75".
            " ".
            (url()->current() === $route?"hvr-underline-from-center-active":"text-gray-500")
            ]
            )
            }}
    href="{{$route}}"
>
    {{$slot}}
</a>
