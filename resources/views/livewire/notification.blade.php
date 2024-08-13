<div x-data="{ notifications: [] }">
    @foreach ($notifications as $notification)
<div x-data="{ show: {{ $notification['show'] ? 'true' : 'false' }} }" x-init="setTimeout(() => show = false, 1000)" x-show="show">
@if ($notification['type'] =='error')
    <div id="error-message" class="bg-red-500 text-white tracking-wider px-3 py-2 text-base  drop-shadow-xl m-auto fixed top-28 right-10 z-50 flex justify-center items-center gap-x-4">
       <x-icons.error/>  {{ $notification['message']  }}<x-icons.cancel  class="cursor-pointer drop-shadow-lg" width="18px" height="18px" fill="#ffffff"/>
    </div>

 
    @elseif($notification['type'] =='success')
<div id="success-message" class="bg-blue-950 text-white tracking-wider px-3 py-2 text-base  drop-shadow-xl m-auto fixed top-28 right-10 z-50 flex justify-center items-center gap-x-4">
    <x-icons.success/> {{ $notification['message']  }}<x-icons.cancel   class="cursor-pointer drop-shadow-lg" width="18px" height="18px" fill="#ffffff"/>
 </div>
@endif
</div>
@endforeach
</div>
