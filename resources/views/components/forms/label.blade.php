<!-- resources/views/components/Forms/button.blade.php -->

@props(['for' => '','class' => '', 'content'])

<label for="{{ $for }}" {{ $attributes->merge(['class' => "text-lg text-normal text-gray-950 uppercase tracking-widest text-left $class"]) }}>
    {{ $content }}
</label>
