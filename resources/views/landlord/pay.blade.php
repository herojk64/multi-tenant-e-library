<x-app-layout>
    <x-landlord.content_wrapper :overlay="true" class="grid" :bg="asset('storage/landlord_home_image_1.png')">
        <div class="bg-black/50 w-11/12 h-full mx-auto p-8">
            <form class="lg:w-1/2 md:w-2/3 mx-auto w-full" method="POST" action="{{route('landlord.pay-services',$services->id)}}">
                @csrf
                <header class="mb-11 font-libre text-center" style="font-size: 2rem">Register Domain</header>

                <div class="mb-14 border border-light-1">
                    <p class="flex justify-between items-center px-6"><span>Amount :</span> <span >Rs.{{$services->amount}}</span></p>
                    <p class="flex justify-between items-center px-6"><span>Discount :</span> <span >{{$services?->discount ?? 0}}%</span></p>
                    <div class="h-0.5 my-2 w-full bg-light-1"></div>
                    <p class="flex justify-between items-center px-6"><span>Total :</span>
                        <span class="">
                            {{$services->amount - ($services->amount * ($services->discount ?? 0)/100)}}
                        </span>
                    </p>
                </div>

                <div class="mb-14" x-data="{value:''}">
                    <x-landlord.form.input
                        label="Domain"
                        type="text"
                        name="domain"
                        class=""
                        x-model="value"
                        autofocus
                    />
                <p class="text-md italic"><span x-html="value.toLowerCase()"></span>.{{config('app.url')}}</p>
                </div>

                <x-landlord.form.button type="submit">
                    Pay
                </x-landlord.form.button>
            </form>
        </div>
    </x-landlord.content_wrapper>
</x-app-layout>
