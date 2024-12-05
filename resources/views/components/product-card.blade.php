@props(['class' => '','product'])

<div onclick="window.location.href='{{ route('product',['id'=>$product->id]) }}'" {{ $attributes->merge(['class' => "w-2/5 md:w-2/12 group flex flex-col gap-y-1 justify-center items-center cursor-pointer px-2 $class"]) }}>
    <div class="relative w-full">
        <x-forms.button content="Sale" type="button" class="capitalize absolute top-0 right-0 w-12 font-medium tracking-widest "/>
 
        <img src="{{ asset('images/'.$product->image_1) }}"  class="w-full h-auto aspect-auto " alt="">
        <x-forms.button content="Quick View" type="button" class="capitalize absolute bottom-5 left-1/2 w-full tracking-widest -translate-x-1/2 hidden group-hover:block transition ease-in-out"/>
    </div>
    <h1 class="text-xl w-full text-center font-medium  tracking-widest text-gray-700">{{$product->name }}</h1>
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
    
    <div class="flex justify-center items-center flex-wrap gap-x-2 text-base font-normal">
        <span class="line-through">Rs.{{ intval($product->base_price) }}</span>
        <span>Rs.{{$product->base_price-($product->base_price*($product->discount/100))}}</span>
        <span class="text-yellow-400">Save Rs.{{$product->base_price*($product->discount/100)}}</span>
    </div>
    

    </div>