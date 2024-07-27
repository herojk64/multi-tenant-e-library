<div
    x-data="{show:true}"
    x-init="setTimeout(()=>show = false,{{$timeout ?? 5000}})"
    x-show="show"
    {{ $attributes->merge(['class'=>'w-full mb-6 py-2 text-success text-center border border-success rounded bg-success bg-opacity-25']) }}>
    {{$slot}}
</div>
