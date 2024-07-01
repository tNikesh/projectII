<div class=" w-3/4 mx-auto flex justify-evenly items-center  border-2 border-gray-400 md:ml-0"> 
    <button class="flex-1 px-2 text-4xl border-r-2 border-gray-400 mx-auto" type="button" wire:click="decrement">-</button>
    <input type="text " value="{{$qty}}" name="qty" readonly
        class="text-center w-full max-w-[150px] text-lg text-green-border-gray-400 font-normal bg-inherit outline-none border-0" />
    <button class="flex-1 px-2 text-4xl border-l-2 border-gray-400" type="button" wire:click="increment">+</button>
</div>