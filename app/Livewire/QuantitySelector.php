<?php

namespace App\Livewire;

use Livewire\Component;

class QuantitySelector extends Component
{
    public $qty=1;
    public function increment(){
        if($this->qty<100)
        {
            $this->qty++;
        }
    }
    public function decrement(){
        if($this->qty>1){
            $this->qty--;
        }
    }
    public function render()
    {
        return view('livewire.quantity-selector');
    }
}
