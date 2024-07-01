<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $item;
    public $id;
    public $show = true;

    public function mount($item)
    {
        $this->item = $item;
        $this->id = $item['pid'];
    }
    public function increment()
    {

        $cart = session()->get('cart');

        if (isset($cart[$this->id]) && ($cart[$this->id]['qty'] < 100)) {
            $cart[$this->id]['qty']++;
            session()->put('cart', $cart);

            // Update Livewire component state
            $this->item['qty'] = $cart[$this->id]['qty'];
        }
    }
    public function decrement()
    {
        $cart = session()->get('cart');

        if (isset($cart[$this->id]) && $cart[$this->id]['qty'] > 1) {
            $cart[$this->id]['qty']--;
            session()->put('cart', $cart);

            // Update Livewire component state
            $this->item['qty'] = $cart[$this->id]['qty'];
        }
    }
    // removing the item from cart
    public function removeItem($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            $this->show=false;
        }
          
    }
    public function render()
    {
        return view('livewire.cart');
    }
}
