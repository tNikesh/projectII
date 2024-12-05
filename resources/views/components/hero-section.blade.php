@props(['class' => '','crousels'])
<section id="heroSection" {{ $attributes->merge(['class' => 'px-10 m-0  w-full !z-30  bg-transparent  $class']) }}>
    <!-- Carousel wrapper -->
    <div class="relative w-full  mx-auto overflow-hidden  ">
        <!-- Carousel inner container -->
        <div id="carouselInside" class="w-full relative flex transition-transform duration-700 ease-in-out">
            <!-- Slide 1 -->
            @forelse ($crousels as $crousel)
                
            <div class="min-w-full w-full flex justify-between items-center md:flex-row flex-col gap-y-4 md:py-5 pb-3  ">
                <div
                    class="animate-textAnim w-full md:w-[50%] py-10 md:px-20 px-0 flex justify-start md:items-start items-center gap-5 flex-col ">
                    <span
                        class="text-gray-800 font-semibold text-base whitespace-nowrap bg-white px-5 py-1 rounded-md drop-shadow-sm ">New
                        Lunch</span>
                        <h1 style="word-spacing: 0.1em; line-height: 2.7rem" 
                        class="bg-gradient-to-br from-green-700 via-rose-400 to-rose-200 text-transparent bg-clip-text font-semibold md:text-[3rem] text-[2.5rem] md:text-left text-center capitalize tracking-wider 
                               drop-shadow-xl hover:text-rose-500 transition-all ease-in-out duration-500 md:px-0 px-2">
                        {{ $crousel->name }}
                    </h1>
                    <h2 class="text-base tracking-wider font-medium capitalize text-black md:px-0 px-2 md:text-left text-center">{{ $crousel->desc??'' }}</h2>

                    
                    <div class="relative flex justify-start items-center gap-7">
                        {{-- <a href="" class="text-white  text-xs font-medium tracking-wide whitespace-nowrap  uppercase bg-rose-500 ring-1 rounded-full drop-shadow-md hover:bg-white hover:text-rose-600  ring-rose-600 bg-opacity-70 px-0 w-36 text-center py-3 ">Buy 1 Get 30% off</a> --}}
                        <a href="{{ route('product',$crousel->id) }}"
                            class="hover:text-white text-xs font-medium tracking-wide whitespace-nowrap  uppercase hover:bg-green-800 ring-1 rounded-full drop-shadow-md bg-white text-green-800  ring-green-800  bg-opacity-70 px-0 w-36 text-center py-3 ">shop
                            now
                            <span class="absolute top-2 right-2  flex h-3 w-3">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class=" w-full md:w-[50%] flex justify-center items-center flex-col gap-10">
                    <img src="{{ asset('images/'.$crousel->image_1) }}" loading="lazy"
                        class="animate-imgAnim w-[80%]  md:w-1/2 -rotate-12 animate-jump-in animate-once aspect-auto object-cover drop-shadow-lg "alt="">
                    <div class=" flex justify-start items-center gap-10">
                        <a href="#" target="_blank"><span
                                class="sr-only">instagram</span>
                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z"
                                        fill="#fb7185"></path>
                                    <path
                                        d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z"
                                        fill=" #fb7185"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z"
                                        fill=" #fb7185"></path>
                                </g>
                            </svg>
                        </a>
                        <a href="#" target="_blank">
                            <span class="sr-only">Facebook</span>
                            <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M20 12.05C19.9813 10.5255 19.5273 9.03809 18.6915 7.76295C17.8557 6.48781 16.673 5.47804 15.2826 4.85257C13.8921 4.2271 12.3519 4.01198 10.8433 4.23253C9.33473 4.45309 7.92057 5.10013 6.7674 6.09748C5.61422 7.09482 4.77005 8.40092 4.3343 9.86195C3.89856 11.323 3.88938 12.8781 4.30786 14.3442C4.72634 15.8103 5.55504 17.1262 6.69637 18.1371C7.83769 19.148 9.24412 19.8117 10.75 20.05V14.38H8.75001V12.05H10.75V10.28C10.7037 9.86846 10.7483 9.45175 10.8807 9.05931C11.0131 8.66687 11.23 8.30827 11.5161 8.00882C11.8022 7.70936 12.1505 7.47635 12.5365 7.32624C12.9225 7.17612 13.3368 7.11255 13.75 7.14003C14.3498 7.14824 14.9482 7.20173 15.54 7.30003V9.30003H14.54C14.3676 9.27828 14.1924 9.29556 14.0276 9.35059C13.8627 9.40562 13.7123 9.49699 13.5875 9.61795C13.4627 9.73891 13.3667 9.88637 13.3066 10.0494C13.2464 10.2125 13.2237 10.387 13.24 10.56V12.07H15.46L15.1 14.4H13.25V20C15.1399 19.7011 16.8601 18.7347 18.0985 17.2761C19.3369 15.8175 20.0115 13.9634 20 12.05Z"
                                        fill=" #fb7185"></path>
                                </g>
                            </svg>
                        </a>

                    </div>
                </div>
            </div>
            @empty
                
            @endforelse
           
        </div>

        <!-- Carousel controls -->
        {{-- previous button --}}
        <x-buttons.prev id="prev" class="" />
        {{-- next button --}}
        <x-buttons.next id="next" />

        @push('scripts')
            <script>
                // JavaScript for carousel functionality of hero section
                const carouselInside = document.getElementById('carouselInside');
                const slides = carouselInside.children;
                const prevButton = document.getElementById('prev');
                const nextButton = document.getElementById('next');
                let currentIndex = 0;
                const totalSlides = slides.length;
                let slideInterval;


                prevButton.classList.toggle('disabled', currentIndex === 0);
                prevButton.classList.toggle('opacity-10', currentIndex === 0);


                // Function to reset the slide interval
                function resetInterval() {
                    clearInterval(slideInterval); // Clear the existing interval
                    // Set a new interval to auto-slide every 3 seconds
                    slideInterval = setInterval(() => {
                        if (currentIndex < totalSlides - 1) {
                            currentIndex++;
                        } else {
                            currentIndex = 0; // Loop back to the first slide
                        }
                        updateCarousel();
                    }, 4000);
                }

                prevButton.addEventListener('click', () => {
                    currentIndex = (currentIndex > 0) ? currentIndex - 1 : 1; // Adjust if more slides
                    updateCarousel();
                    resetInterval();
                });

                nextButton.addEventListener('click', () => {
                    currentIndex = (currentIndex < 1) ? currentIndex + 1 : 0; // Adjust if more slides
                    updateCarousel();
                    resetInterval();
                });

                function updateCarousel() {
                    const offset = -currentIndex * 100; // Assuming each slide is 100% of the carousel width
                    carouselInside.style.transform = `translateX(${offset}%)`;
                    updateButtonState();
                }

                function updateButtonState() {
                    // Disable the previous button if on the first slide
                    prevButton.disabled = currentIndex === 0;
                    prevButton.classList.toggle('disabled', currentIndex === 0);
                    prevButton.classList.toggle('opacity-10', currentIndex === 0);

                    // Disable the next button if on the last slide
                    nextButton.disabled = currentIndex === totalSlides - 1;
                    nextButton.classList.toggle('disabled', currentIndex === totalSlides - 1);
                    nextButton.classList.toggle('opacity-10', currentIndex === totalSlides - 1);
                }
                resetInterval();
            </script>
        @endpush



    </div>
</section>
