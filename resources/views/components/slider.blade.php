@props(['class'=>''])
<section id="header" {{ $attributes->merge(["class"=>"conatiner p-4 w-full bg-primary z-10 $class"]) }}>
    <div class="w-full  overflow-hidden">
        <div class="flex justify-evenly items-center overflow-x-auto no-scrollbar scroll-smooth space-x-3 md:space-x-32">
          <!-- Image 1 -->
          <div class="min-w-[100px] md:min-w-[150px] flex flex-col gap-y-4 justify-center items-center">
            <img src="{{ asset('images/soap.png') }}" alt="Image 1" class="w-full  h-auto p-2 md:p-10 bg-secondary aspect-auto rounded-full">
            <span class="uppercase font-normal md:font-medium text-black text-sm md:text-xl">soap</span>
          </div>
          <div class="min-w-[100px] md:min-w-[150px] flex flex-col gap-y-4 justify-center items-center">
            <img src="{{ asset('images/anti-age.png') }}" alt="Image 1" class="w-full  h-auto p-2 md:p-10 bg-secondary aspect-auto rounded-full">
            <span class="uppercase font-normal md:font-medium text-black text-sm md:text-xl">face</span>
        </div>
          <div class="min-w-[100px] md:min-w-[150px] flex flex-col gap-y-4 justify-center items-center">
            <img src="{{ asset('images/fireworks.png') }}" alt="Image 1" class="w-full  h-auto p-2 md:p-10 bg-secondary aspect-auto rounded-full">
            <span class="uppercase font-normal md:font-medium text-black text-sm md:text-xl">new lunch</span>
        </div>
          <div class="min-w-[100px] md:min-w-[150px] flex flex-col gap-y-4 justify-center items-center">
            <img src="{{ asset('images/coupon.png') }}" alt="Image 1" class="w-full  h-auto p-2 md:p-10 bg-secondary aspect-auto rounded-full">
            <span class="uppercase font-normal md:font-medium text-black text-sm md:text-xl">sale</span>
        </div>
          <div class="min-w-[100px] md:min-w-[150px] flex flex-col gap-y-4 justify-center items-center">
            <img src="{{ asset('images/best-seller.png') }}" alt="Image 1" class="w-full  h-auto p-2 md:p-10 bg-secondary aspect-auto rounded-full">
            <span class="uppercase font-normal md:font-medium text-black text-sm md:text-xl">best seller</span>
        </div>
      
          <!-- Add more images as needed -->
        </div>
      </div>
    </body>
</section>