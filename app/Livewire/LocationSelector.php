<?php

namespace App\Livewire;

use Livewire\Component;

class LocationSelector extends Component
{
    public $provinces;
    public $districts =null;
    public $selectedProvince = null;
    public $selectedDistrict = null;

    public function mount()
    {
        $this->provinces = config('province');
        
    }
    
    public function updatedSelectedProvince()
    {
        $this->districts = $this->provinces[$this->selectedProvince];
        $this->selectedDistrict = null;
        // dd($this->districts);
    }

    public function render()
    {
        // dump($this->districts);
        return view('livewire.location-selector', [
            'newDistricts' => $this->districts,
        ]);
    }
}
