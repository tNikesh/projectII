<!-- resources/views/components/Forms/button.blade.php -->

@props(['type' => '','class' => '', 'name'=>'','placeholder'=>''])

<input type="{{ $type }}" name="{{ $name }}"  placeholder="{{ $placeholder }}" {{ $attributes->merge(['class' => "bg-primary w-full h-[40px] border border-gray-900 text-normal pl-2  $class"]) }}/>
  

