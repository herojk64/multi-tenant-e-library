<div x-data="{ rating: @entangle('rating'), hoverRating: 0 }" class="flex items-center space-x-2">
    @for ($i = 1; $i <= 5; $i++)
        <svg
            @mouseover="hoverRating = {{ $i }}"
            @mouseleave="hoverRating = 0"
            @click="rating = {{ $i }}; $wire.rate({{ $i }})"
            :class="hoverRating >= {{ $i }} || rating >= {{ $i }} ? 'text-yellow-500' : 'text-gray-300'"
            class="w-8 h-8 cursor-pointer transition-colors duration-300"
            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
        </svg>
    @endfor
</div>

@if (session()->has('message'))
    <div class="text-green-500">{{ session('message') }}</div>
@endif
