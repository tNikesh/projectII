@props(['class'=>''])
<section {{ $attributes->merge(['class'=>'p-0 m-0 w-full bg-primary z-10 $class']) }} >
       <!-- Carousel wrapper -->
       <div class="relative w-full  mx-auto overflow-hidden ">
        <!-- Carousel inner container -->
        <div id="carouselInside" class="relative flex transition-transform duration-700 ease-in-out">
            <!-- Slide 1 -->
            <div class="min-w-full ">
                <img src="{{ asset('images/hero1.jpg') }}" class="w-full" alt="Slide 1">
            </div>
            <!-- Slide 2 -->
            <div class="min-w-full">
                <img  src="{{ asset('images/hero2.jpg') }}" class="w-full" alt="Slide 2">
            </div>
        </div>

        <!-- Carousel controls -->
        {{-- previous button --}}
        <x-buttons.prev id="prev"/>
        {{-- next button --}}
        <x-buttons.next id="next"/>

        @push('scripts')
        <script>
    
            // JavaScript for carousel functionality of hero section
            const carouselInside = document.getElementById('carouselInside');
            const prevButton = document.getElementById('prev');
            const nextButton = document.getElementById('next');
            let currentIndex = 0;
        
            prevButton.addEventListener('click', () => {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : 1; // Adjust if more slides
                updateCarousel();
            });
        
            nextButton.addEventListener('click', () => {
                currentIndex = (currentIndex < 1) ? currentIndex + 1 : 0; // Adjust if more slides
                updateCarousel();
            });
        
            function updateCarousel() {
                const offset = -currentIndex * 100; // Assuming each slide is 100% of the carousel width
                carouselInside.style.transform = `translateX(${offset}%)`;
            }
        </script>
        
        @endpush


       
    </div>
</section>
