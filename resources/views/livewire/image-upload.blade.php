<div class="w-full flex flex-col justify-center items-center gap-y-3">
    <div class="relative w-[70px] h-[70px]">
        <!-- Hidden File Input -->
        <input type="file" name="images[]" id="file-input" class="hidden" accept="image/*" wire:model="images" multiple wire:model.defer="images"/>
        <!-- Custom File Input -->
        <div id="custom-file-input" class="w-full h-full flex items-center justify-center cursor-pointer bg-white drop-shadow-md">
            <span class="text-green-500 text-2xl">+</span>
        </div>
    </div>
    <div class="container w-full flex justify-center items-center ">
   <!-- Validation error messages -->
        @error('images.*')              
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      <!-- Flash message for image count error -->
    </div>  
    <div wire:loading wire:target="images" class="text-center text-gray-500">
        Loading...
    </div>
    <div class="w-full flex  justify-evenly items-start flex-wrap content-evenly gap-y-3">
        @foreach ($previews as $preview)    
        <div wire:key="preview-{{ $loop->index }}" class="w-1/5  bg-gray-300 drop-shadow-lg cursor-pointer ">
            <img src="{{ $preview }}" class ="w-full h-auto aspect-auto object-cover "alt="">
        </div>
        @endforeach
    </div>
</div>