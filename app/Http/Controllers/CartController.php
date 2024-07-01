<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // add to cart controller
    public function add(Request $req)
    {
        // retricing the product id and its quantity
        $pid = $req->input('pid');

        $qty = $req->input('qty', 1);
        // Fetch product details
        $product = Product::find($pid);
        if (!$product) {
            // Handle case where product with given id doesn't exist
            return redirect()->route('home')->with('error', 'Product not found');
        }
        // initalizing the cart in session
        $cart = session()->get('cart', []);

        if (isset($cart[$pid])) {
            $cart[$pid]['qty'] += $qty;
        } else {
            $cart[$pid] = [
                'pid' => $pid,
                'qty' => $qty,
                'price' => $product->base_price,
                'discount' => $product->discount,
                'name' => $product->name,
                'image' => $product->image_1,
            ];
        }
        session(['cart' => $cart]);
        //    session()->flush();
        return redirect()->route('home');
    }
}
