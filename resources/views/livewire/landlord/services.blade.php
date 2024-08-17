<div class="w-full">
            <!-- Buttons for each service type -->
            <section class="flex items-center justify-center gap-2 mb-4">
                    @foreach($types as $type)
                        <button
                            class="px-4 py-2 border border-gray-300 rounded transition ease-in-out duration-300 {{$this->section ===  $type->value  ? 'bg-gray-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'}}"
                            wire:click="toggle('{{ $type->value }}')"
                        >
                            {{ $type->name }}
                        </button>
                    @endforeach
            </section>
            <!-- Display services based on selected type -->
            <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @if(!$services->isEmpty())
                @foreach($services as $service)
                        <div class="border border-gray-600 bg-gray-600 text-white p-4 flex flex-col justify-between rounded-md">
                            <header class="text-xl font-semibold mb-2">{{ $service->title }}</header>
                            <p class="text-white mb-2">{{ $service->description }}</p>
                            <div class="text-lg font-bold mb-2">Amount: ${{ $service->amount }}</div>
                            <div class="text-sm text-gray-200 mb-4">Discount: {{ $service->discount }}%</div>
                            @if(!$tenant)
                            <a href="{{ route('landlord.services.pay', $service) }}" class="text-center px-6 py-2 w-full bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                                    Apply
                            </a>
                                @endif
                            @if($tenant)
                            <a href="{{route('landlord.services.update-view',[$tenant,$service])}}" class="text-center px-6 py-2 w-full bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                                Apply
                            </a>
                                @endif
                        </div>
                @endforeach
                @else
                    <div>
                        There are no services yet!
                    </div>
                @endif
            </section>
</div>
