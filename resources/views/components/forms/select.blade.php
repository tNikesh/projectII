<!-- resources/views/components/Forms/button.blade.php -->

@props(['class' => '','name'=>'','placeholder'=>'','options'=>[], 'selected' => '', ])

<select name="{{ $name }}"  {{ $attributes->merge(['class' => "w-full border border-black text-left h-10 pl-2 $class"]) }}>
    @if($placeholder)
    <option value="">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $value =>$text )
    <option value="{{ $text->id }}" @if( $selected==$text->title) selected @endif>{{ $text->title }}</option>    
    @endforeach
</select>

