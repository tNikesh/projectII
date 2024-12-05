<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackOrder extends Controller
{
    public function index(){
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->latest()->paginate(3);
        return view('track-order',compact('orders'));
    }
}
