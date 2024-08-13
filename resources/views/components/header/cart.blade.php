@props(['class'=>''])

<div  id="cart" {{ $attributes->merge(['class'=>"fixed w-full max-w-[425px] h-[100vh]  top-0 right-0 translate-x-full transform transition-transform duration-500 ease-in-out bg-[#FAF7FC] border border-gray-200 drop-shadow-2xl z-50 overflow-y-scroll $class"]) }}>
<div  class="w-full  p-8 flex justify-between items-center">
    <h1 class="text-3xl uppercase font-bold">Cart</h1>
    <svg id="hide-cart" class="cursor-pointer bg-gray-200 p-1" width="25px" height="25px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000" stroke="#000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="work-case" fill="#000" transform="translate(91.520000, 91.520000)"> <polygon id="Close" points="328.96 30.2933333 298.666667 1.42108547e-14 164.48 134.4 30.2933333 1.42108547e-14 1.42108547e-14 30.2933333 134.4 164.48 1.42108547e-14 298.666667 30.2933333 328.96 164.48 194.56 298.666667 328.96 328.96 298.666667 194.56 164.48"> </polygon> </g> </g> </g></svg>  

</div>
<div class="container flex flex-col items-center justify-center  divide-y divide-gray-300 border-y border-gray-300">
        <livewire:cart />
</div>
    <a href="{{ route('checkout') }}" class="block text-xl mt-12 font-semibold bg-gray-800 text-white w-10/12  mx-auto text-center py-5 capitalize tracking-widest" >checkout</a>
</div>