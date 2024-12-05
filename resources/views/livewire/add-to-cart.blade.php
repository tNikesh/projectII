@props(['class' => '', 'productId'])

<div class="W-full">
    @if ($added)
    <button type="button" disabled {{ $attributes->merge(['class' => 'bg-gray-50 w-40 py-3 px-1 text-gray-800 text-xs tracking-wider font-bold uppercase ring ring-gray-800 opacity-70'. $class]) }}>
       Added In Cart
    </button>
@else
    <button type="button" wire:click.prevent.debounce.100ms="addToCart({{ $productId }})" {{ $attributes->merge(['class' => 'bg-black w-40 py-3 px-1 text-gray-50 text-xs tracking-wider font-bold uppercase hover:ring-1 hover:ring-gray-900 hover:bg-primary hover:text-gray-900'. $class]) }}>
       Add to Cart
    </button>
@endif
</div>
