<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @livewireStyles
    <style>
        /* Optionally, you can add custom styles for better appearance */
        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hidden {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
    <title>Document</title>
</head>

<body class="w-screen h-screen bg-primary overflow-x-hidden p-0 m-0">
    <x-header.header />
    <main class="w-full flex flex-col items-center justify-center bg-[#fed7d0] gap-y-16 py-14">
        <div class="w-full flex flex-col md:flex-row items-center justify-center gap-y-7 md:w-11/12 md:items-start">
            <div class="w-full md:w-5/12 flex justify-center items-center flex-col gap-y-4">
                <img id="mainImage" src="" class="w-3/4 h-auto aspect-auto flex items-center justify-center flex-col"
                    alt="">
                <div id="thumbnailImage"
                    class="w-4/5 flex justify-center items-center gap-x-1 overflow-x-auto scrollbar-hidden whitespace-nowrap">
                    @forelse ($images as $image )
                    <img src="{{ asset('images/'.$image) }}" data-src="{{ asset('images/'.$image) }}"
                        class="w-1/4 max-w-40  h-auto aspect-auto" alt="{{ $product->name }}"
                        onclick="changeMainImage(this)">
                    @empty
                    <p class="text-center text-gray-500 mt-4">No additional images available for this product.</p>
                    @endforelse
                </div>
            </div>
            <form method="POST" action="{{ route('add.cart') }}"
                class="w-full md:w-5/12 flex justify-center items-center md:items-start flex-col space-y-5 md:space-y-8">
                @csrf
                <input type="text" hidden name="pid" value="{{ $product->id }}">
                <span class="font-extrabold md:text-5xl text-black text-center md:text-left uppercase text-4xl">{{
                    $product->name }}</span>
                <div
                    class="flex items-center justify-center gap-x-4 w-full md:justify-start md:gap-x-7 flex-wrap gap-y-3">
                    <span class="text-3xl line-through text-gray-800 font-semibold tracking-wider">Rs.{{
                        $product->base_price }}</span>
                    <span
                        class="text-4xl text-red-500 font-bold tracking-wider">Rs.{{$product->base_price-($product->base_price*($product->discount/100))}}</span>
                </div>
                <span class="uppercase tracking-widest font-normal text-2xl text-gray-800 text-center">quantity</span>
                @livewire('quantity-selector')
                <x-forms.button content="add to cart" type="submit" class="w-4/5 py-4 text-xl" />
            </form>
        </div>
    </main>
    <x-footer />
    <script>
        function changeMainImage(image) {
            var newSrc=image.getAttribute('data-src');
            var mainImage=document.getElementById('mainImage');
            mainImage.setAttribute('src',newSrc);
        }
        document.addEventListener('DOMContentLoaded',function(){
            var firstThubnail=document.querySelector('#thumbnailImage img[data-src]')
            if(firstThubnail){
                firstThubnail.click();
            }
        })
    </script>
    @stack('scripts')
    @livewireScripts

</body>

</html>