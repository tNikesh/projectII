<div  class="w-full flex justify-between items-start md:flex-row flex-col gap-4 py-2">
    <div class="w-full">
    <div class="w-full flex justify-start items-center gap-3 ">
        <x-forms.label for="province" content="province" />
        <select wire:model.lazy="selectedProvince" name="province"
            class="w-full  text-center h-10 text-lg capitalize bg-primary">
            <option value="">select province</option>
            @foreach ($provinces as $province => $districts)
                <option value="{{ $province }}">{{ $province }}</option>
            @endforeach
        </select>
    </div>
        @error('province')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="w-full">
    <div class="w-full flex justify-start items-center gap-x-2">
        <x-forms.label for="district" content="district" />
        <select name="district" class="w-full  text-center h-10 text-lg capitalize bg-primary">
            <option value="">select district</option>
            @if ($newDistricts)
                @foreach ($newDistricts as $district)
                    <option value="{{ $district }}">{{ $district }}</option>
                @endforeach
            @endif

        </select>
    </div>
        @error('district')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
</div>
</div>
