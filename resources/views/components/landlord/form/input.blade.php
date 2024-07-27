@if($type === "checkbox" || $type === "radio")

    <input
        {{$attributes->merge([
    'class'=>'custom-checkbox appearance-none h-4 w-4 border border-light-1 rounded focus:outline-none focus:ring-2 focus:ring-light-1'
    ])}}
        type="{{$type}}"
        name="{{$name}}"
        id="{{$id ?? ($name ?? '')}}"
        {{ old($name) ? 'checked' : '' }}
    >

    <label class="" for="{{$id ?? ($name ?? '')}}">
        {{\Illuminate\Support\Str::headline($label)}}
    </label>

    @else
<label for="{{$id ?? ($name ?? '')}}" class="">{{\Illuminate\Support\Str::headline($label)}}</label>
<input
    type="{{$type ?? 'text'}}"
    name="{{$name ?? 'name'}}"
    {{$attributes->merge([
    'class'=>'block w-full bg-transparent border-b border-b-light-1 outline-none focus-visible:outline-none mt-2 py-2'
    ])}}
    id="{{$id ?? ($name ?? '')}}"
    placeholder="{{$placeholder ?? ''}}"
    value="{{old($name)}}"
/>
@endif
@error($name ?? 'name')
<span class="text-sm text-red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
@enderror
