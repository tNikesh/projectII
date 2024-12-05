<x-app-layout>
    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-y-7 md:w-11/12 md:items-start py-16">
        <div class="w-full md:w-5/12 flex justify-center items-center flex-col gap-y-4">
            <img id="mainImage" src="" class="w-3/4 h-auto aspect-auto flex items-center justify-center flex-col"
                alt="">
            <div id="thumbnailImage"
                class="w-4/5 flex justify-center items-center gap-x-1 overflow-x-auto scrollbar-hidden whitespace-nowrap">
                @forelse ($images as $image)
                    <img src="{{ asset('images/' . $image) }}" data-src="{{ asset('images/' . $image) }}"
                        class="w-1/4 max-w-40 h-auto aspect-auto" alt="{{ $product->name }}"
                        onclick="changeMainImage(this)">
                @empty
                    <p class="text-center text-gray-500 mt-4">No additional images available for this product.</p>
                @endforelse
            </div>
        </div>
        <form method="POST" action="{{ route('add.cart') }}"
            class="w-full md:w-5/12 flex justify-center items-center md:items-start flex-col space-y-5 md:space-y-8">
            @csrf
            <input type="text" hidden name="pid" value="{{ $product->id }}">
            <span
                class="font-extrabold md:text-5xl text-black text-center md:text-left uppercase text-4xl">{{ $product->name }}</span>
                <div class="flex justify-start items-center gap-x-2 font-medium capitalize"><span class="whitespace-nowrap">Category :</span>
                <span class="flex justify-start items-center gap-1 text-sm">
                    @forelse ($product->category as $ctg )
                        
                    <span>{{ $ctg->title }}</span>    
                    @empty
                        
                    @endforelse
                </span></div>
               <div class="flex justify-center items-center">
                @if ($product->avg_rating!=0)
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $product->avg_rating)
                        <x-filled_star />
                    @else
                        <x-fillable_star />
                    @endif
                @endfor
                @endif

               </div>
            <div class="flex items-center justify-center gap-x-4 w-full md:justify-start md:gap-x-7 flex-wrap gap-y-3">
                <span
                    class="text-3xl line-through text-gray-800 font-semibold tracking-wider">Rs.{{ $product->base_price }}</span>
                <span
                    class="text-4xl text-red-500 font-bold tracking-wider">Rs.{{ $product->base_price - $product->base_price * ($product->discount / 100) }}</span>
            </div>
            @if(($product->stock)>0)
            <livewire:add-to-cart :productId="$product->id" wire:key="single-product-{{ $product->id }}" />
            @else
            <button type="button" class="bg-black w-40 py-3 px-1 text-gray-50 text-xs tracking-wider font-bold uppercase opacity-90">
                Out Of Stock
            </button>   
            @endif
            <div>
                {{ $product->desc??'' }}
            </div>
        </form>
    </div>
    <div class="w-full px-10 flex flex-col items-end justify-center py-5">
        <div class="">
            <span class="text-green font-medium text-lg capitalize cursor-pointer">write your review. Good or Bad
                ?</span>
            <form action="{{ route('review', $product->id) }}" method="POST"
                class="flex justify-center items-start flex-col gap-y-4">
                @csrf
                <x-star-rating :rating="old('rating', 0)" />
                <textarea placeholder="Describe your experience" name="review" rows="4" cols="50"
                    class="p-2 bg-white drop-shadow-md"></textarea>
                @error('rating')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                @error('review')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <x-forms.button type="submit" content="post" />
            </form>
        </div>
        <div class="w-full flex justify-start items-center flex-wrap gap-4">
            @foreach ($product->review as $r)
                <div class="flex justify-start flex-col items-start bg-white p-4 rounded shadow-md mb-4">
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col items-start justify-start"> <span
                                class="capitalize font-medium whitespace-nowrap">{{ $r->user->name }}</span>
                            <span
                                class="capitalize text-gray-500 whitespace-nowrap">{{ $r->created_at->format('M d,y') }}</span>
                        </div>
                        <div class="flex justify-center items-center gap-x-0">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $r->ratings)
                                    <x-filled_star />
                                @else
                                    <x-fillable_star />
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="pt-2">{{ $r->reviews }}</div>
                </div>
            @endforeach
        </div>
    </div>
    <div>
        <h3 class="text-black text-lg font-medium w-full text-center pb-5 capitalize">Recommended products</h3>
        <div class="w-full flex justify-start items-center gap-10 px-10">
            @forelse ($similarProducts as $similar )
        <div class="flex items-center justify-start flex-col gap-y-1 w-2/5 md:w-2/12">
            <div class=" relative w-full flex items-center ">
                <span
                    class="absolute top-0 left-0 w-16 text-center py-1 bg-[#b18724] text-white font-medium text-base drop-shadow-md">-{{ intval($similar->discount) }}%</span>
                <img src="{{ asset('images/' . $similar->image_1) }}" class="w-full h-auto aspect-auto "
                    alt="">
            </div>
            <a href="{{ route('product',$similar->id) }}" 
                class=" py-1 w-full text-sm px-5 text-center whitespace-nowrap bg-black text-white capitalize font-bold" >Buy Now</a>

            <div class="flex justify-center items-center gap-x-4 flex-wrap">
                <span
                    class="font-medium text-gray-900 text-lg">Rs.{{ $similar->base_price - $similar->base_price * ($similar->discount / 100) }}</span>
                <span class="font-normal text-gray-500 line-through text-base">Rs.{{ $similar->base_price }}</span>
            </div>
            <span class="text-lg uppercase font-bold text-center ">{{ $similar->name }}</span>
            <div class="flex items-center justify-center gap-0 md:gap-1">
            </div>
        </div>

        @empty
            
        @endforelse
        </div>
    </div>
</x-app-layout>
