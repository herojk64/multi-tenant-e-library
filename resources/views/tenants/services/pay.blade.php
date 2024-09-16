<x-tenant-app-layout>
    @php
        if(!isset($tenant)){
            $tenant = null;
        }
    @endphp
    <main class="bg-white max-w-4xl p-6 rounded mx-auto">
        <h1 class="text-2xl font-bold mb-4">Payment Details</h1>

        <!-- Service Details -->
        <div class="border border-gray-300 p-6 rounded mb-6">
            <header class="text-xl font-semibold mb-2">{{ $service->title }}</header>
            <p class="mb-2">{{ $service->description }}</p>
            <div class="text-lg font-bold mb-2">Amount: {{ $service->amount }}</div>
            <div class="text-sm text-gray-600 mb-4">Discount: {{ $service->discount }}%</div>
            <div class="text-lg font-bold mb-2">Total: {{$service->amount-($service->amount*($service->discount/100))}}</div>
        </div>

        @if($tenant)
            <header>Tenant Details</header>
            <div class="border border-gray-300 p-6 rounded mb-6">
                <header class="text-xl font-semibold mb-2">Name: {{ $tenant->name }}</header>
                <p class="mb-2">Domain: {{ $tenant->domain }}</p>
            </div>
        @endif
        <form action="{{route('services.pay-services',$service)}}" method="POST">
            @csrf
            @method('POST')
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300 w-full">
                {{$tenant?"Activate":"Submit"}}
            </button>
        </form>
    </main>
</x-tenant-app-layout>
