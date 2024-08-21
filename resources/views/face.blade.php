<x-app-layout >
    <section class="flex items-center justify-center w-full md:justify-evenly gap-x-5 md:gap-x-20 gap-y-10 md:gap-y-14 flex-wrap md:px-14 py-14">
        <h1 class="w-full text-center font-bold uppercase text-4xl tracking-widest">Face</h1>
              <div class="flex items-center justify-center w-full md:justify-evenly gap-x-5 md:gap-x-20 gap-y-10 md:gap-y-14 flex-wrap md:px-14">
                @foreach($faces as $product)
                
                <x-product-card :product="$product"/>
                @endforeach
              </div>
        </section>
</x-app-layout>
