<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center p-4 bg-red-100 border border-red-300 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M3.35 4.35a1.25 1.25 0 011.76 0L12 9.8l6.89-5.45a1.25 1.25 0 111.76 1.76L13.54 12l6.11 5.89a1.25 1.25 0 01-1.76 1.76L12 14.2l-6.89 5.45a1.25 1.25 0 01-1.76-1.76L10.46 12 3.35 6.11a1.25 1.25 0 010-1.76z"/>
            </svg>
            <div class="ml-3 text-red-700">
                <p class="font-semibold">{{ $this->message() }}</p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
