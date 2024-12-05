<div class="w-full py-6 space-y-3">
@forelse ($cartItems as $cartItem )
    
<div class="container py-0 w-full flex justify-center items-center px-10 gap-x-4 ">
    <div class="w-full max-w-[100px]  border border-gray-500">
        <img src="{{ asset('images/'.$cartItem->product->image_1) }}" class="w-full h-auto aspect-auto drop-shadow-md " alt="">
    </div>
    <div class="relative w-full flex flex-col justify-start items-start gap-y-1">
        <span class="font-medium text-base uppercase">{{ $cartItem->name }}</span>
        <div class=" w-3/4  flex justify-evenly items-center   border-2 border-gray-400 md:ml-0"> 
            <button class="flex-1 px-1 text-2xl border-r-2 border-gray-400 mx-auto" type="button" wire:click.prevent.debounce.100ms="increment({{ $cartItem->id }},false)">-</button>
            <input type="text " value="{{ $cartItem->quantity }}" name="qty" readonly
                class="text-center w-full max-w-[150px] text-lg text-green-border-gray-400 font-normal bg-inherit outline-none border-0" />
            <button class="flex-1 px-1 text-2xl border-l-2 border-gray-400" type="button" wire:click.prevent.debounce.100ms="increment({{ $cartItem->id }},true)">+</button>
        </div>
        <div class="">
            <div class="flex justify-center items-center gap-x-3">
                <span class="text-black text-base tracking-wider ">Rs.{{$cartItem->product->base_price*$cartItem->quantity-($cartItem->product->base_price*$cartItem->quantity*$cartItem->product->discount/100) }}</span>
            <span class="line-through text-gray-400 text-base">Rs.{{$cartItem->product->base_price*$cartItem->quantity }}</span>
            </div>
            <span class="font-semibold text-lg text-green-700 tracking-wider">(SAVE Rs.{{$cartItem->product->base_price*$cartItem->quantity*$cartItem->product->discount/100}})</span>
        </div>
        <svg class="absolute top-1 -right-6 cursor-pointer" wire:click.prevent.debounce.100ms="removeItem('{{ $cartItem->id }}')" width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="24" height="24" fill="none"></rect> <path d="M5 7.5H19L18 21H6L5 7.5Z" stroke="#000000" stroke-linejoin="round"></path> <path d="M15.5 9.5L15 19" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 9.5V19" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8.5 9.5L9 19" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16 5H19C20.1046 5 21 5.89543 21 7V7.5H3V7C3 5.89543 3.89543 5 5 5H8M16 5L15 3H9L8 5M16 5H8" stroke="#000000" stroke-linejoin="round"></path> </g></svg>
    </div>
   </div>
   @empty
   <p class="text-center text-sm text-gray-700">No items in cart</p> 
    
@endforelse
</div>