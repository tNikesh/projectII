@props(['class'=>''])
<nav id="nav-bar" {{ $attributes->merge(["class"=>"md:block absolute left-0 translate-y-full md:translate-x-0 md:translate-y-0  -translate-x-full tranfrom transition-transform duration-500 ease-in-out bottom-0 w-full h-[100vh] md:h-auto bg-transparent drop-shadow-md md:filter-none md:no-shadow md:relative  $class"]) }}>
    <ul class="flex bg-white md:bg-primary justify-center items-start md:gap-7 flex-wrap  divide-y divide-gray-200 md:divide-y-0 md:flex-row  md:gap-y-0">
        <li class="w-full h-14 md:w-auto md:h-10 ">
            <a href="{{ route('home') }}" class="peer no-underline transition ease-in duration-300 active:bg-gray-700 active:text-white hover:bg-gray-100 md:hover:bg-primary md:activer:bg-primary flex justify-start items-center pl-4 md:p-0 text-black  p-0 w-full h-full md:h-5/6 font-sm tracking-widest font-normal uppercase">home</a>
            <div class="hidden md:block md:bg-black md:h-[2px] md:w-0 md:peer-hover:w-full md:transition-all md:duration-500"></div>
        </li>
       
      @forelse ($categories as $category)
      <li class="w-full h-14 md:w-auto md:h-10 ">
        <a href="{{ route('category.show',$category->id) }}" class="peer no-underline transition ease-in duration-300 active:bg-gray-700 active:text-white hover:bg-gray-100 md:hover:bg-primary md:activer:bg-primary flex justify-start items-center pl-4 md:p-0 text-black  p-0 w-full h-full md:h-5/6 font-sm tracking-widest font-normal uppercase">{{ $category->title }}</a>
        <div class="hidden md:block md:bg-black md:h-[2px] md:w-0 md:peer-hover:w-full md:transition-all md:duration-500"></div>
    </li>
    @empty
      @endforelse
        <li class="w-full h-14 md:w-auto md:h-10 ">
            <a href="{{ route('track.order') }}" class="peer no-underline transition ease-in duration-300 active:bg-gray-700 active:text-white hover:bg-gray-100 md:hover:bg-primary md:activer:bg-primary flex justify-start items-center pl-4 md:p-0 text-black  p-0 w-full h-full md:h-5/6 font-sm tracking-widest font-normal uppercase">track order</a>
             <div class="hidden md:block md:bg-black md:h-[2px] md:w-0 md:peer-hover:w-full md:transition-all md:duration-500"></div>
        </li>
    </ul>
</nav>