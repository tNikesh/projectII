@if (session('error'))
    <div id="error-message" class="bg-red-500 text-white tracking-wider px-3 py-2 text-base  drop-shadow-xl m-auto fixed top-28 right-10 z-50 flex justify-center items-center gap-x-4">
       <x-icons.error/> {{ session('error') }}<x-icons.cancel onclick="document.getElementById('error-message').remove();"  class="cursor-pointer drop-shadow-lg" width="18px" height="18px" fill="#ffffff"/>
    </div>

    @endif
    @if(@session('success'))
<div id="success-message" class="bg-blue-950 text-white tracking-wider px-3 py-2 text-base  drop-shadow-xl m-auto fixed top-28 right-10 z-50 flex justify-center items-center gap-x-4">
    <x-icons.success/> {{ session('success') }}<x-icons.cancel onclick="document.getElementById('success-message').remove();"  class="cursor-pointer drop-shadow-lg" width="18px" height="18px" fill="#ffffff"/>
 </div>
@endif