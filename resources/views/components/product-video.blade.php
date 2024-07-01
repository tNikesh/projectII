@props(['class'=>''])
<section  {{ $attributes->merge(['class'=>'py-14 pl-5 md:pl-0  w-full  bg-primary z-10 $class']) }} >
    <h1 class="text-center font-light uppercase tracking-wider text-[23px] ">watch & shop now</h1>
    <!-- Carousel wrapper -->
    <div class="relative w-full flex items-center  mx-auto overflow-hidden">
        <!-- Carousel inner container -->
        <div id="carousel" class="carousel-inner flex items-center space-x-4 md:space-x-16 overflow-x-auto" >
            @for ($i=0;$i<=5;$i++)
            <!-- Slide 1 -->
            <div
                class="flex flex-shrink-0 gap-y-2 flex-col mt-6 bg-white pb-1 object-cover overflow-hidden rounded-md drop-shadow-video-card   md:w-[260px] w-[240px]">
                <div
                    class=" overflow-hidden text-white shadow-lg bg-clip-border bg-blue-gray-500 shadow-blue-gray-500/40">
                    <video  controls class="w-full h-auto aspect-[9/16]">
                        <source src="{{ asset('images/product-video.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="flex justify-start items-center gap-x-3 px-2">
                    <img class="rounded-full bg-primary shadow-md" src="{{ asset('images/product.webp') }}" width="30px"
                        height="30px" alt="">
                    <h2 class="uppercase font-semibold text-base">underarm cream</h2>
                </div>
                <div class="flex justify-center items-center gap-x-2">
                    <span class="font-normal text-gray-900 text-base">Rs.3500</span>
                    <span class="font-normal text-gray-500 line-through text-sm">Rs.4000</span>
                    <span class="font-normal text-green-500 text-xs">15% OFF</span>
                </div>
            </div>
            @endfor
        </div>
        <!-- PREV Button -->
        <x-buttons.prev id="prev1"/>
        <!-- Next Button -->
        <x-buttons.next id="next1"/>
    </div>
</section>

@push('scripts')
<script>
    //  function displayVideoCrousel() {
    //     document.getElementById('video-container').style.display = 'flex';
    // }

    // const videoElement=document.querySelectorALl('.video-element');
    // let videosReady=0;

    // videoElement.forEach(video=>{
    //      // Add an event listener for the 'canplaythrough' event
    //     video.addEventListener('canPlayThrough',function(){
    //         videosReady++
    //         //check if all the videos are ready to play
    //         if(videosReady==videoElement.length){
    //             displayVideoCrousel();
    //         }
    //         document.getElementById('video-container').style.display = 'block';
    //     },{once:true})//ensure event listener only fires once
    // })

    // scrolling the videos
    document.getElementById('next1').addEventListener('click', function() {
    document.getElementById('carousel').scrollBy({ left: 300, behavior: 'smooth' });
});
document.getElementById('prev1').addEventListener('click', function() {
    document.getElementById('carousel').scrollBy({ left: -300, behavior: 'smooth' });
});
</script>   
@endpush