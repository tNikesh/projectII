<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>

    </style>
    @vite('resources/css/app.css')
</head>

<body class="bg-white w-screen h-screen p-0 m-0 overflow-x-hidden">
    <x-admin.side-bar />
    <main class="w-[87%] absolute right-0 top-0 p-16">
        <section>
          <div class="flex justify-between items-center">
            <h1 class="w-full text-left font-medium text-lg my-7 ">Products</h1>
            <a href="{{ route('add.product') }}" class="bg-gray-800 py-2 px-5 text-white text-sm whitespace-nowrap uppercase">add new product</a>
          </div>
          <div class="w-full bg-gray-50 drop-shadow-lg ">
              <table class="min-w-full  text-left   table-fixed divide-y-2 divide-slate-200">
                <thead class=" text-gray-700 bg-slate-50 ">
                  <tr class="divide-x divide-slate-200">  
                    <td class="py-1 px-2"></td> 
                    <td class="py-1 px-2">ID</td> 
                    <td class="py-1 px-2">Name</td>
                    <td class="py-1 px-2">Price</td>
                    <td class="py-1 px-2">Discount</td>
                    <td class="py-1 px-2">Stock</td>
                    <td class="py-1 px-2">Description</td>
                    <td class="py-1 px-2">Category</td>
                    <td class="py-1 px-2">Action</td>
                  </tr>
                </thead>
                <tbody class="text-base font-normal divide-y bg-white divide-slate-200">
                  @foreach ($products as $product )     
                  <tr class="divide-x divide-slate-200  ">
                    <td class="py-1 px-2 w-24"><img src="{{ asset('images/'.$product->image_1) }}" alt=""></td>
                    <td class="py-1 px-2 w-auto">{{$product->id}}</td>
                    <td class="py-1 px-2 w-32">{{$product->name}}</td>
                    <td class="py-1 px-2 w-auto whitespace-nowrap">Rs. {{$product->base_price}} /-</td>
                    <td class="py-1 px-2 w-auto whitespace-nowrap">Rs. {{$product->discount}} /-</td>
                    <td class="py-1 px-2 w-auto">{{$product->stock}}</td>
                    <td class="py-1 px-2 w-40"><div class="h-32 overflow-x-auto  w-full">
                      {{$product->desc}}</div></td>
                    <td class="py-1 px-2 w-32">
                    @forelse ($product->category as $ctg )
                      
                    {{$ctg->title}},
                    @empty
                    
                    @endforelse
                  </td>
                    <td class="py-1 px-2 w-32">
                      <a href="{{ route('edit.product',$product->id) }}" class="bg-gray-900 text-white px-4 py-1 text-sm ">edit</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="conatiner py-6">
                {{ $products->links('vendor.pagination.tailwind') }}
              </div>
            </div>
           </section>
    </main>
    @stack('scripts')
</body>

</html>