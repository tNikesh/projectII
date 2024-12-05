<x-app-layout>

    <x-hero-section :crousels="$crousels" />

    {{-- slider --}}
    <x-slider class="md:px-5 px-2" />
    {{-- best seller section --}}
    <section class="  py-14 px-5 flex flex-col gap-y-7 justify-evenly items-center w-full z-10 bg-primary">
        <h1 class="uppercase tracking-wider text-[23px] font-medium ">Top Rated Product</h1>

        {{-- products outer conatiner --}}
        <div
            class="flex items-center justify-center w-full md:justify-evenly gap-x-5 md:gap-x-20 gap-y-10 md:gap-y-14 flex-wrap md:px-14">

            {{-- each itsm --}}
            @forelse ($products as $best)
                <div class="flex items-center justify-start flex-col gap-y-1 w-2/5 md:w-2/12">
                    <div class=" relative w-full flex items-center ">
                        <span
                            class="absolute top-0 left-0 w-16 text-center py-1 bg-[#b18724] text-white font-medium text-base drop-shadow-md">-{{ intval($best->discount) }}%</span>
                        <img src="{{ asset('images/' . $best->image_1) }}" class="w-full h-auto aspect-auto "
                            alt="">
                    </div>
                    <a href="{{ route('product', $best->id) }}"
                        class=" py-1 w-full whitespace-nowrap text-sm px-5 text-center bg-black text-white capitalize font-bold">Buy
                        Now</a>
                    <div class="flex justify-center items-center gap-x-4 flex-wrap">
                        <span
                            class="font-medium text-gray-900 text-lg">Rs.{{ $best->base_price - $best->base_price * ($best->discount / 100) }}</span>
                        <span class="font-normal text-gray-500 line-through text-base">Rs.{{ $best->base_price }}</span>
                    </div>
                    <span class="text-lg uppercase font-bold text-center ">{{ $best->name }}</span>
                    <div class="flex items-center justify-center gap-0 md:gap-1">
                        <div class="flex items-center justify-center gap-0 ">
                            @if ($best->avg_rating != 0)
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $best->avg_rating)
                                        <x-filled_star />
                                    @else
                                        <x-fillable_star />
                                    @endif
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
            @empty
            <p class="text-center w-full text-gray-600 capitalize">no product avaibale</p>
            @endforelse
        </div>
    </section>



    @if ($review != null)
        <section class="w-full flex flex-col justify-center items-center gap-y-10 py-10 bg-white z-10">
            <a href="#" target="_blank"
                class="bg-black px-1 text-white text-center tracking-wider font-bold uppercase  w-40 py-2 text-lg">follow
                us!</a>
            <h1 class="text-xl text-gray-700 font-semibold mx-2 text-center ">SEEING IS BELIEVING...
            </h1>
            <div
                class="flex flex-col gap-y-5  bg-rose-50 justify-center items-center px-14 py-7 w-full max-w-[850px] rounded-tl-[40%] md:rounded-tl-full rounded-br-[40%] md:rounded-br-full">
                <div class="flex justify-center items-center gap-x-0">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->ratings)
                            <x-filled_star />
                        @else
                            <x-fillable_star />
                        @endif
                    @endfor
                </div>
                <p class="text-lg text-gray-800 text-center border-b border-gray-400 pb-10 mx-5">{{ $review->reviews }}
                </p>
                <span class="text-lg text-gray-800 font-semibold">{{ $review->user->name }}</span>
            </div>
        </section>
    @endif

</x-app-layout>
