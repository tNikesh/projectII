<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $delivery = config('delivery.delivery_price');
        $user = Auth::user();
        $carts = Cart::with('product')->where('user_id', $user->id)->get();
        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
        $subTotal = $carts->sum(function ($cart) {
            $price = $cart->product->base_price;
            $qty = $cart->quantity;
            $discount = $cart->product->discount; // Assuming discount is a percentage

            // Calculate the price after discount
            $discountedPrice = $price - ($price * ($discount / 100));

            // Calculate the total price for this cart item after discount
            return $discountedPrice * $qty;
        });


        return view('checkout', compact('carts', 'delivery', 'subTotal'));
    }
    public function store(Request $req)
    {
        $req->validate([
            'email' => 'nullable|email',
            'number' => 'required|numeric',
            'fname' => 'required|string|min:2|max:50',
            'lname' => 'required|string|min:2|max:50',
            'province' => 'required|string|min:2|max:50',
            'district' => 'required|string|min:2|max:50',
            'city' => 'required|string|min:2|max:50',
            'street' => 'required|string|min:2|max:100',
            'payment' => 'required|string|in:paid,unpaid',
        ]);
        try {
            DB::transaction(function () use ($req) {
                $user = Auth::user();
                $cartItems = $user->cart;
                if ($cartItems->isEmpty()) {
                    throw new \Exception('Checkout Failed! Your cart is empty.');
                }
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'full_name' => $req->fname . ' ' . $req->lname,
                    'email' => $req->email,
                    'number' => $req->number,
                    'province' => $req->province,
                    'district' => $req->district,
                    'city' => $req->city,
                    'street' => $req->street,
                    'payment_status' => 'unpaid',
                    'grand_total' => 0,
                ]);

                foreach ($cartItems as $cartItem) {

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                    ]);
                    $cartItem->delete();
                }
                // Update the grand_total column in the orders table
                $order->grand_total = $order->grandTotal();
                $order->save();
            });
            // Check payment status and redirect to payment gateway if necessary
            if ($req->input('payment') === 'paid') {
                // Redirect to payment gateway page for further processing
               // If everything went well, redirect to a success page or display a success message
        return redirect()->route('home')->with('success', 'paymenet interation left !');
            } else {
                // Redirect to order success page or display a success message
               // If everything went well, redirect to a success page or display a success message
        return redirect()->route('home')->with('success', 'Your checkout process completed !');
            }
        } catch (\Exception $e) {
            // Handle the exception, e.g., log the error, send a notification, etc.
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during checkout. Please try again.');
        }
        // If everything went well, redirect to a success page or display a success message
        // return redirect()->route('home')->with('success', 'Your checkout process completed !');
    }
}
