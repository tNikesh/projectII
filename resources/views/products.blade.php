<x-app-layout >
    <section class="flex items-center justify-center w-full md:justify-evenly gap-x-5 md:gap-x-20 gap-y-10 md:gap-y-14 flex-wrap md:px-14 py-14">
     <div class="w-full">
      <h1 class="w-full text-center font-bold uppercase text-4xl tracking-widest">{{ $category->title }}</h1>
      <form method="GET" action="{{ route('category.show', $category->id) }}" class="w-full flex justify-end mb-8">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search for products..." 
            class="px-4 h-10 border sm:w-[400px] w-[70%]"
        />
        <button type="submit" class=" px-4 h-10 bg-gray-900 text-white ">Search</button>
    </form>
     </div>
              <div class="flex items-center justify-center w-full md:justify-evenly gap-x-5 md:gap-x-20 gap-y-10 md:gap-y-14 flex-wrap md:px-14">
                @forelse($products as $item)
                
                <x-product-card :product="$item"/>
                @empty
                <p class="text-sm text-gray-500">No products found</p>
                @endforelse
              </div>
              <div class="w-full flex justify-between items-center mt-8">
                {{ $products->links() }}  <!-- Pagination links for the paginated products -->
            </div>
        </section>
</x-app-layout>
