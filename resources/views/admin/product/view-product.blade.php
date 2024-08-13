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
    <main class="w-[83%] absolute right-0 top-0 p-16">
        <section>
            <h1 class="w-full text-left font-medium text-lg my-7 ">ALL Product</h1>
            <div class="w-full bg-gray-50 drop-shadow-lg py-10 px-7">
              <table class="min-w-full  text-left  border-collapse border-spacing-2 border-2 border-gray-800 table-fixed divide-y-2 divide-gray-800">
                <thead class="text-lg font-medium bg-gray-800 text-white">
                  <tr class="divide-x divide-gray-500">  
                    <td class="py-3 px-2">Image</td> 
                    <td class="py-3 px-2">PID</td> 
                    <td class="py-3 px-2">Name</td>
                    <td class="py-3 px-2">Description</td>
                    <td class="py-3 px-2">Product Category</td>
                    <td class="py-3 px-2">Action</td>
                  </tr>
                </thead>
                <tbody class="text-base font-normal divide-y divide-gray-500">
                  @foreach ($products as $product )     
                  <tr class="divide-x divide-gray-500 h-14 ">
                    <td class="py-3 px-2 w-32"><img src="{{ asset('images/'.$product->image_1) }}" alt=""></td>
                    <td class="py-3 px-2 w-32">{{$product->id}}</td>
                    <td class="py-3 px-2 w-32">{{$product->name}}</td>
                    <td class="py-3 px-2 w-32">{{$product->desc}}</td>
                    <td class="py-3 px-2 w-32">{{$product->productCategory->title}}</td>
                    <td class="py-3 px-2 w-32">
                      <form action="{{ route('destroy.product') }}" method="POST">
                        @csrf
                        @method('Delete')
                        <input type="text" value="{{ $product->id }}" name="deleteId" hidden>
                        <x-forms.button content="delete" type="submit"/>
                      </form>
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