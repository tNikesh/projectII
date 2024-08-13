<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\Attributes\On; 

class AddToCart extends Component
{
    #[locked]
    public $productId;
    public $added=false;
    public $userId;

    protected $listeners = ['removedCart' => 'updateCartStatus'];

    public function mount($productId){
        $this->productId=$productId;
        $this->userId=Auth::id();
        $this->checkIfAdded();

    }
    public function updateCartStatus()
    {
        $this->checkIfAdded();
        // $this->render();
    }
   
    public function addToCart($productId){
      
        if (!$this->userId) {
            return redirect()->route('login');
        }

        Cart::create([
            'user_id' => $this->userId,
            'product_id' => $productId,
            'quantity' => 1,
        ]);

        $this->added = true;
         $this->dispatch('addedCart');
        
    }
    private function checkIfAdded()
    {
   
        if ($this->userId) {
            $this->added = Cart::where('user_id', $this->userId)
                               ->where('product_id', $this->productId)
                               ->exists();
        }
    }
    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
