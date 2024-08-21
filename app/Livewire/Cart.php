<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{
    public $userId;
    public $show = true;


    protected $listeners = ['addedCart' => 'updateCartStatus'];

    public function mount()
    {
     $this->userId=Auth::id();      
    }
    public function updateCartStatus(){
        $this->render();
    }
    public function increment($cartId,$increment)
    {
        
        $cart = \App\Models\Cart::with('product:id,stock')->findOrFail($cartId);
        if($increment){
            if ($cart->quantity >= $cart->product->stock) { 
                    // Handle the out-of-stock case if needed
                    $this->dispatch('notification', ['type' => 'error', 'message' => 'This product is out of stock!']);
                return;
            }
            if($cart->quantity<100){
                $cart->quantity+=1;
            }
        }
        else{
            if($cart->quantity>1){
                $cart->quantity-=1;
            }
        }
        $cart->save();

    }

    // removing the item from cart
    public function removeItem($cartId)
    {
        $cart = \App\Models\Cart::findOrFail($cartId);
        $cart->delete();
       $this->dispatch('removedCart');
          
    }
    public function render()
    {
        $cartItems=\App\models\cart::with('product')->where('user_id',$this->userId)->get();
        return view('livewire.cart',compact('cartItems'));
    }
}
