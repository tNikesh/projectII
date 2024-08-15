<x-app-layout>

    {{-- hero-section --}}
    <x-hero-section />

    {{-- slider --}}
    <x-slider class="px-5" />

    {{-- product-video-slider --}}
    <x-product-video class="px-5 " />

    {{-- best seller section --}}
    <section class="  py-14 px-5 flex flex-col gap-y-7 justify-evenly items-center w-full z-10 bg-primary">
        <h1 class="uppercase tracking-wider text-[23px] font-medium ">Recommended Product</h1>
        
        {{-- products outer conatiner --}}
        <div
            class="flex items-center justify-center w-full md:justify-evenly gap-x-5 md:gap-x-20 gap-y-10 md:gap-y-14 flex-wrap md:px-14">
          
            {{-- each itsm --}}
            @foreach ($recommendedProducts as $best)
                <div class="flex items-center justify-start flex-col gap-y-1 w-2/5 md:w-2/12">
                    <div class=" relative w-full flex items-center ">
                        <span
                            class="absolute top-0 left-0 w-16 text-center py-1 bg-[#b18724] text-white font-medium text-base drop-shadow-md">-{{ intval($best->discount) }}%</span>
                        <img src="{{ asset('images/' . $best->image_1) }}" class="w-full h-auto aspect-auto "
                            alt="">
                    </div>
                    <livewire:AddToCart wire:key="product-{{ $best->id }}" :productId="$best->id"
                        class=" py-3 w-full text-xl capitalize font-bold" />
                    <div class="flex justify-center items-center gap-x-4 flex-wrap">
                        <span
                            class="font-medium text-gray-900 text-lg">Rs.{{ $best->base_price - $best->base_price * ($best->discount / 100) }}</span>
                        <span class="font-normal text-gray-500 line-through text-base">Rs.{{ $best->base_price }}</span>
                    </div>
                    <span class="text-lg uppercase font-bold text-center ">{{ $best->name }}</span>
                    <div class="flex items-center justify-center gap-0 md:gap-1">
                        @for ($j = 0; $j < 5; $j++)
                            <x-rating />
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
        <x-forms.button content="view all products" type="button" class="max-w-72 w-full p-2 text-lg font-medium" />
    </section>

    <section class=" flex items-center text-white py-32 bg-transparent ">
        <div style="background-image: url('{{ asset('images/productBg.jpg') }}');"
            class="opacity-95 bg-cover bg-no-repeat fixed h-screen w-svw bottom-0 left-0 z-0"></div>
        <div class=" w-full max-w-[700px] m-auto flex justify-center items-center flex-col gap-y-1 px-3 ">
            <h2 class="uppercase font-semibold text-2xl z-10">uniquely styled</h2>
            <h1 class="uppercase text-center font-bold text-3xl z-10">do we sell only soaps ?</h1>
            <p class="font-medium text-lg text-center z-10 ">The real definition of soap is cleanse and lather. Ghar
                Soaps isn't focussed on selling only soaps, facewash etc.. like other brands do. Our motive is to solve
                all your skin care problems with our simple and effective products.</p>
            <x-forms.button content="shop now" type="button"
                class="bg-primary text-gray-950 ring-2 ring-gray-950 hover:ring-primary hover:bg-black hover:text-primary transition-all z-10 w-36 text-lg" />
        </div>
    </section>

    <section
        class="w-full flex flex-col justify-center py-20 items-center gap-y-7 border-b border-gray-400 bg-primary px-5  z-10">
        <h1 class=" uppercase tracking-wider text-[23px] font-medium ">most viewed</h1>
        <div
            class="w-full flex p-3 md:p-0 md:justify-evenly items-center justify-center flex-grow-0 gap-y-12 flex-wrap md:w-[90%]">
            @for ($i = 0; $i < 4; $i++)
                <div class="w-full max-w-[260px] mx-auto relative bg-red-400">
                    <img src="{{ asset('images/main-soap.jpg') }}" class="w-full h-auto aspect-auto opacity-95"
                        alt="product image">
                    <x-forms.button content="face" type="button"
                        class="bg-primary text-gray-950 ring-2 ring-gray-950 hover:ring-primary hover:bg-black hover:text-primary transition-allw-40 absolute top-1/2 left-1/2 -translate-x-1/2 translate-y-1/2 py-3" />
                </div>
            @endfor
        </div>
    </section>

    <section class="w-full flex flex-col justify-center items-center gap-y-10 py-10 bg-primary z-10">
        <x-forms.button content="follow us!" type="button" class="w-40 py-2 text-lg" />
        <h1 class="text-xl text-black font-semibold mx-2 text-center">DON'T JUST TAKE OUR WORD FOR IT...</h1>
        <div
            class="flex flex-col gap-y-5  bg-secondary justify-center items-center px-14 py-7 w-full max-w-[850px] rounded-tl-[40%] md:rounded-tl-full rounded-br-[40%] md:rounded-br-full">
            <div class="flex justify-center items-center">
                @for ($i = 0; $i < 5; $i++)
                    <x-rating />
                @endfor
            </div>
            <p class="text-lg text-gray-800 text-center border-b border-gray-400 pb-10 mx-5">It's been a week. I am
                using shampoo powder and my hair fall has reduced along with increase in volume. Remarkable!</p>
            <span class="text-lg text-gray-800 font-semibold">Disha O.</span>
        </div>
    </section>
</x-app-layout>
