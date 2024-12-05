<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\EsewaServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

require '../vendor/autoload.php';

use RemoteMerge\Esewa\Client;

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
        foreach ($carts as $cart) {
            // Get the product related to the cart item
            $product = $cart->product;
    
            // Check if the cart item's quantity is greater than the product's stock
            if ($cart->quantity > $product->stock) {
                // Handle the out-of-stock case for the specific item
                return redirect()->back()->with('error', "The product {$product->name} is out of stock or you have exceeded the available quantity.");
            }
            if($cart->quantity>5 || $cart->quantity<1){
                return redirect()->back()->with('error', "The product {$product->name} is more than 5 or less than 0");

            }
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
            'payment' => 'required|string|in:esewa,cod',
        ]);
        $user = Auth::user();
        $error = false;
        $product = '';
        $cartItems = $user->cart;
        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('error', 'Checkout Failed! Your cart is empty.');
        }
        // Check if each product in the cart has enough stock
        foreach ($cartItems as $cartItem) {
            if ($cartItem->product->stock < $cartItem->quantity) {
                $error = true;
                $product = $cartItem->product->name;
                break;
            }
        }
        if ($error) {
            return redirect()->route('home')->with('error', 'Failed! Item (' . $product . ') does not have enough stock.');
        }
        try {
           DB::beginTransaction();
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'full_name' => $req->fname . ' ' . $req->lname,
                    'email' => $req->email,
                    'number' => $req->number,
                    'province' => $req->province,
                    'district' => $req->district,
                    'city' => $req->city,
                    'street' => $req->street,
                    'payment_status' => 'cod',
                    'grand_total' => 0,
                ]);

                foreach ($cartItems as $cartItem) {

                    $orderItem = OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                        'base_price' => $cartItem->product->base_price,
                        'discount' => $cartItem->product->discount,
                    ]);
                    // Decrease the stock directly
                    $orderItem->product->decrement('stock', $orderItem->quantity);
                    $cartItem->delete();
                }
                // Update the grand_total column in the orders table
                $order->grand_total = $order->grandTotal();
                $order->save();
                DB::commit();
                // Check payment status and redirect to payment gateway if necessary
                if ($req->payment =='esewa') {
                    // Set success and failure callback URLs.
                    $successUrl = url('/success');
                    $failureUrl = url('/failure');

                    // Initialize eSewa client for development.
                    $esewa = new Client([
                        'merchant_code' => 'EPAYTEST',
                        'success_url' => $successUrl,
                        'failure_url' => $failureUrl,
                    ]);

                    $esewa->payment($order->id, $order->grand_total, 0, 0, 0);
                } else {
                    // dd('hi');
                    // If everything went well, redirect to a success page or display a success message
                    DB::commit();
                    return redirect()->route('track.order')->with('success', 'Your checkout process completed !');
                }
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the exception, e.g., log the error, send a notification, etc.
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during checkout. Please try again.');
        }

    }


}
