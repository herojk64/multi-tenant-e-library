<x-app-layout>
    <x-landlord.content_wrapper :overlay="true" class="grid" :bg="asset('storage/landlord_home_image_1.png')">
        <div class="bg-black/50 w-11/12 h-full mx-auto p-8" x-data="{ plan: '{{$types[0]->value }}' }">

            <header class="mb-11 font-libre text-center" style="font-size: 2rem">Subscription Plans</header>
            {{--            Switcher --}}

            <div class="flex justify-center mb-8 font-libre">
                <div class="p-2 bg-primary">
                @foreach($types as $type)
                        <button
                            @click="plan = '{{$type->value}}'"
                            :class="plan === '{{$type->value}}' ? 'bg-light-1 text-primary' : 'bg-primary'"
                            class="px-4 py-2 transition-colors duration-300 ease-in-out"
                        >
                            {{\Illuminate\Support\Str::headline($type->value)}}
                        </button>
                @endforeach
                </div>
            </div>

            {{-- Subscription Plans --}}
            @foreach($types as $type)
                @php
                    $filteredData = $data->filter(function ($item) use ($type) {
                        return $item->type === $type;
                    });
                @endphp
                <div x-show="plan === '{{$type->value}}'" class="flex flex-wrap items-center justify-center gap-3">
                    @if($filteredData->isEmpty())
                        <div class="text-center py-4 px-5">
                            <p class="text-md font-light mb-5">There are no offers yet.</p>
                        </div>
                    @else
                    @foreach($filteredData as $value)
                        <div class="flex flex-col justify-between bg-light text-black py-12 px-5 self-stretch" style="width: 16rem;">
                            <header class="mb-2 text-xl font-bold">{{ $value->title }}</header>
                            <p class="text-sm text-light-1 font-light mb-5">{{ $value->description }}</p>
                            <p class="font-extrabold text-3xl">Rs. {{ $value->amount }}</p>
                            @if($value->discount !== 0)
                            <p class="font-extrabold text-lg">Discount: {{$value->discount}}%</p>
                            @endif
                            <form method="GET" action="{{route('landlord.pay',$value->id)}}">
                                @csrf
                            <button class="mt-8 bg-primary text-white px-4 py-2 w-full">
                                Buy Now
                            </button>
                            </form>
                        </div>
                    @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    </x-landlord.content_wrapper>
</x-app-layout>
