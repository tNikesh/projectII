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
            <div class="flex justify-start items-center w-full gap-x-1 pb-6 relative">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000">
                    <path
                        d="M640-121v-120H520v-80h120v-120h80v120h120v80H720v120h-80ZM120-240v-80h80v80h-80Zm160 0v-80h163q-3 21-2.5 40t3.5 40H280ZM120-400v-80h80v80h-80Zm160 0v-80h266q-23 16-41.5 36T472-400H280ZM120-560v-80h80v80h-80Zm160 0v-80h480v80H280ZM120-720v-80h80v80h-80Zm160 0v-80h480v80H280Z" />
                </svg>
                <h1 class="font-medium text-lg">Edit Product</h1>
            </div>
            <form action="{{ route('update.product',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('Patch')
                <div class="w-full flex justify-center items-start content-evenly flex-wrap gap-10 ">
                    {{-- general product infromation --}}
                    <div class="w-1/2 bg-zinc-100 flex flex-col justify-center items-center gap-5 py-10 px-9 drop-shadow-md">
                        <h2 class="font-medium text-base">General information</h2>
                        <div class="w-full">
                            <x-forms.label for="name" content="Product Name" />
                            <x-forms.input name="name" placeholder="Enter Product Name" value="{{ $product->name }}" class="bg-zinc-200 text-base "
                                autofocus />
                                @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <x-forms.label for="desc" content="Product Description" />
                            <x-forms.text-area name="desc" placeholder="Enter Product Description" value="{{ $product->desc }}" cols="7" rows="4"
                                class="bg-zinc-200 text-base" />
                                @error('desc')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- image section --}}
                    <div class="w-2/5 h-fit min-h-[200px] py-4 bg-zinc-100 drop-shadow-md ">
                        <h2 class="font-medium text-base pb-4 text-center">Upload Max. 4 Images</h2>
                        <input type="file" name="images[]" id="file-input"   accept="image/*"  multiple />
                        @error('images.*')              
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                      @enderror
                        @error('images')              
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                      @enderror
                    </div>
                    {{-- pricing section --}}
                    <div class="w-1/2 bg-zinc-100 flex flex-col justify-center items-center  gap-5 py-10 px-9 drop-shadow-md">
                        <h2 class="font-medium text-base">Pricing And Stock</h2>
                        <div class="w-full">
                            <x-forms.label for="base_price" content="Base Pricing" />
                            <x-forms.input name="base_price" value="{{ $product->base_price }}" placeholder="Enter Base Price" class="bg-zinc-200 text-base "
                                autofocus />
                                @error('base_price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full flex justify-center items-center gap-x-6">
                            <div class="w-full">
                                <x-forms.label for="stock" content="stock"  />
                                <x-forms.input name="stock" placeholder="Add stock"  class="bg-zinc-200 text-base " />
                                @error('stock')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="w-full">
                                <x-forms.label for="discount" content="Dicount%" />
                                <x-forms.input name="discount" value="{{ $product->discount }}" placeholder="10%" class="bg-zinc-200 text-base " />
                                @error('discount')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                    </div>

                     {{-- category section --}}
                     <div class="w-2/5 bg-zinc-100 flex flex-col justify-center items-center  gap-5 py-10 px-9 drop-shadow-md">
                        <h2 class="font-medium text-base">Category</h2>
                        <div class="w-full flex flex-col justify-center items-center gap-y-1 ">
                            <x-forms.label for="category" content="Product Category" />
                            <select name="category[]"  class="w-full border border-black text-left h-10 pl-2 " multiple>
                                <option value="">select category</option>
                                @forelse ($productCategories as $category )     
                                <option value="{{ $category->id }}"  {{ in_array($category->id,$selectedCategories )?'selected':'' }} >{{ $category->title }}</option>    
                                @empty                                    
                                @endforelse
                            </select>
                            @error('category')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                            @error('category.*')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        </div>
                    
                    </div>
                </div>
                <x-forms.button content="Update product" type="submit" class="absolute top-16 right-20 w-44"/>
            </form>
        </section>
    </main>


</body>

</html>