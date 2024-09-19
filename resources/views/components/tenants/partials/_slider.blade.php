<div x-data="slider()" x-init="init()" class="relative w-[99vw] overflow-hidden px-4">
    <!-- Slider Container -->
    <div x-ref="slidesContainer" class="flex space-x-4 overflow-x-auto scroll-smooth pb-5">
        {{ $slot }}
    </div>

    <!-- Navigation Buttons -->
    <button @click="prev()" class="md:block hidden absolute left-2 top-1/2 transform -translate-y-1/2 text-white p-2 bg-blue-500 active:bg-blue-600 hover:bg-blue-300 transition delay-75 ease-in-out  rounded-full">
        <x-heroicon-s-chevron-left class="w-8 h-8 bg-transparent text-white rounded-full"/>
    </button>
    <button @click="next()" class="md:block hidden absolute right-2 top-1/2 transform -translate-y-1/2 text-white p-2 rounded-full bg-blue-500 active:bg-blue-600 hover:bg-blue-300 transition delay-75 ease-in-out">
        <x-heroicon-s-chevron-right class="w-8 h-8 bg-transparent text-white rounded-full"/>
    </button>
</div>

@push('js')
    <script>
        function slider() {
            return {
                slidesContainer: null,
                slideEnd:false,
                init() {
                    this.slidesContainer = this.$refs.slidesContainer;
                    this.slideWidth = this.slidesContainer.children[0]?.offsetWidth || 0;
                },
                prev() {
                    const scrollAmount = this.slideWidth * 0.8; // Scroll by 80% of the container's width
                    const maxScrollLeft = this.slidesContainer.scrollWidth - this.slidesContainer.clientWidth;

                    if (this.slidesContainer.scrollLeft <= 0) {
                        this.slidesContainer.scrollTo({ left: maxScrollLeft, behavior: 'smooth' });
                    } else {
                        this.slidesContainer.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                    }
                },
                next() {
                    const scrollAmount = this.slideWidth * 0.8; // Scroll by 80% of the container's width
                    const maxScrollLeft = this.slidesContainer.scrollWidth - this.slidesContainer.clientWidth;

                    if (this.slidesContainer.scrollLeft + this.slidesContainer.clientWidth >= maxScrollLeft) {

                        if(this.slideEnd){
                        this.slidesContainer.scrollTo({ left: 0, behavior: 'smooth' });
                        this.slideEnd= false;
                        }else{
                            this.slideEnd = true;
                            this.slidesContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                        }
                    } else {
                        this.slidesContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                    }
                }
            }
        }
    </script>
@endpush
