@props(['class'=>'','name'=>'','rows'=>'','cols'=>'','value'=>''])
<textarea  rows="{{ $rows }}" cols="{{ $cols }}" {{ $attributes->merge(["class"=>"  w-full h-15 border border-gray-300 outline-2 outline-black p-4  $class"]) }} name="{{ $name }}">
{{ $value }}   
</textarea>