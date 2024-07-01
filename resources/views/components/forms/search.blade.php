@props(['class'=>'','type'=>"search",'placeholder'=>'','name'=>''])
<input type="{{ $type }}" {{ $attributes->merge(["class"=>"md:w-7/12 w-full h-15 border border-gray-300 outline-2 outline-black bg-primary p-4  $class"]) }} placeholder="{{ $placeholder }}" name="{{ $name }}"/>
