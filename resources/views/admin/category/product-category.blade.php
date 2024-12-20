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
  <x-admin.side-bar/>
  <main class="w-[87%] absolute right-0 top-0 p-5">
   <section>
    <div class="flex justify-between items-center my-7">
    <h1 class="w-full text-left font-medium text-lg  ">Product Category</h1>
    <x-forms.button id="product-category" content="new product category" class="w-56 mb-14 bg-white text-gray-900 ring-1 ring-black hover:bg-gray-800 hover:!text-black"/>
   </div>
    <div class="w-full ">
      <table class="min-w-full w-full drop-shadow-sm  text-left   table-auto divide-y-1 divide-slate-200">
        <thead class=" bg-slate-50 text-gray-800">
          <tr class="divide-x divide-slate-200">  
            <td class="py-1 px-2">PID</td>
            <td class="py-1 px-2">Category Name</td>
            <td class="py-1 px-2">Action</td>
          </tr>
        </thead>
        <tbody class="text-base font-normal divide-y bg-white divide-slate-200">
          @foreach ($categories as $category )     
          <tr class="divide-x divide-slate-200">
            <td class="py-1 px-2">{{$category->id}}</td>
            <td class="py-1 px-2">{{$category->title}}</td>
            <td class="py-1 px-2">
               <x-forms.button content="edit" type="button" class="edit-btn" data-id="{{ $category->id }}" data-title="{{ $category->title }}"/>
              {{-- <form action="{{ route('delete.product.category') }}" method="POST">
                @csrf
                @method('Delete')
                <input type="text" value="{{ $category->id }}" name="deleteId" hidden>
                <x-forms.button content="delete" type="submit"/>
              </form> --}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="conatiner py-6">
        {{ $categories->links('vendor.pagination.tailwind') }}
      </div>
    </div>
   </section>
   <section id="category-modal" class="z-50 absolute top-0 left-1/2 -translate-x-1/2 -translate-y-full w-full max-w-[550px] py-8 px-5 bg-white border-2 border-black flex flex-col justify-center items-center gap-y-10 drop-shadow-xl transform transition-all duration-300 ease-in-out"  >
    <h1 class="w-full text-left uppercase text-lg font-semibold ">product category</h1>
    {{-- form --}}
    <form class="flex flex-col justify-center items-center w-full gap-y-7 px-7"  action="{{ route('post.product.category') }}" method="POST">
      @csrf
      <div class="flex flex-col justify-center items-start  w-full ">
        <x-forms.label for="title" content="Product title" class=""/>
        <x-forms.input name="title" placeholder="Enter Product title" class="w-full text-gray-700 bg-white" autofocus/>
      </div>

     <div class="flex justify-center items-center gap-x-2 w-full">
      <x-forms.button type="button" id="cancel" content="cancel" class="w-full py-3 bg-white ring-1 ring-gray-800 text-gray-800 hover:text-white hover:!bg-gray-800"/>
      <x-forms.button type="submit" content="create new category" class="w-full py-3 ring-1 ring-gray-800 hover:text-gray-800 hover:bg-white"/>
     </div>
    </form>
   </section>
   <section id="edit-modal" class="z-50 absolute top-0 left-1/2 -translate-x-1/2 -translate-y-full w-full max-w-[550px] py-8 px-5 bg-white border-2 border-black flex flex-col justify-center items-center gap-y-10 drop-shadow-xl transform transition-all duration-300 ease-in-out"  >
    <h1 class="w-full text-left uppercase text-lg font-semibold ">Edit product category</h1>
    {{-- form --}}
    <form class="flex flex-col justify-center items-center w-full gap-y-7 px-7"  action="{{ route('update.category') }}" method="POST">
      @csrf
      @method('PATCH')
      <input type="text" name="id" id="id" hidden>
      <div class="flex flex-col justify-center items-start  w-full ">
        <x-forms.label for="editTitle" content="Product title" class=""/>
        <x-forms.input name="editTitle" id="title"  placeholder="Enter Product title" class="w-full text-gray-700 bg-white" autofocus/>
      </div>

     <div class="flex justify-center items-center gap-x-2 w-full">
      <x-forms.button type="button" id="cancelEdit" content="cancel" class="w-full py-3 bg-white ring-1 ring-gray-800 text-gray-800 hover:text-white hover:!bg-gray-800"/>
      <x-forms.button type="submit" content="Update category" class="w-full py-3 ring-1 ring-gray-800 hover:text-gray-800 hover:bg-white"/>
     </div>
    </form>
   </section>
  </main>
  @stack('scripts')
  <script>
    const openModal=document.getElementById('product-category');
    const cancel=document.getElementById('cancel');
    const hiddenModal=document.getElementById('category-modal');
// display the modal
    document.addEventListener('DOMContentLoaded',function(){
      openModal.addEventListener('click',function(){
        hiddenModal.classList.add('top-1/4');
        hiddenModal.classList.remove('-translate-y-full');
      })
      // hide the modal
        cancel.addEventListener('click',function(){
          hiddenModal.classList.remove('top-1/4');
          hiddenModal.classList.add('-translate-y-full');
        })
    })

    const editBtn=document.querySelectorAll('.edit-btn');
    const cancelbtn=document.getElementById('cancelEdit');
    const editModal=document.getElementById('edit-modal');
    const inputId=document.getElementById('id');
    const inputTitle=document.getElementById('title');
    editBtn.forEach(btn=>{
      btn.addEventListener('click',function(){  
        const id=btn.dataset.id;
        const title=btn.dataset.title;
        inputId.value=id;
        inputTitle.value=title;
        editModal.classList.add('top-1/4');
        editModal.classList.remove('-translate-y-full');
      });
    });
    cancelbtn.addEventListener('click',function(){
      editModal.classList.remove('top-1/4');
      editModal.classList.add('-translate-y-full');
    })

  </script>
</body>

</html>