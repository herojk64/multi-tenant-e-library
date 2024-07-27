<div {{$attributes->merge(['class'=>'bg-overlay-container text-light-1 py-6','style'=>"
background-image: url({$bg});
     background-attachment: fixed;
     background-position: center;
     background-repeat: no-repeat;
     background-size: cover;
     min-height: 70svh;
     position: relative;
"])}} style="

">
    {{$slot}}
</div>
@if(isset($overlay) && $overlay)
@push('styles')
<style>
    .bg-overlay-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
        z-index: 1;
    }

    .bg-overlay-container > * {
        position: relative;
        z-index: 2;
    }
</style>
@endpush
@endif
