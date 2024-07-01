<!-- resources/views/components/Forms/button.blade.php -->

@props(['type' => 'button','class' => '', 'content'])

<button type="{{ $type }}" {{ $attributes->merge(['class' => "bg-black w-24 py-2 px-1 text-gray-50 text-xs tracking-wider font-bold uppercase hover:ring-1 hover:ring-gray-900 hover:bg-primary hover:text-gray-900 $class"]) }}>
    {{ $content }}
</button>
