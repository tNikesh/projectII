<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalOrders = Order::count();
        $totalCancelledOrders = Order::where('delivery_status', '=', 'cancelled')->count();
        $totalRevenue = Order::where('delivery_status', 'delivered')->sum('grand_total');
        $deliveredOrders = Order::where('delivery_status', 'delivered')->count();
$canceledOrders = Order::where('delivery_status', 'cancelled')->count();

$deliveryRate = $totalOrders > 0 ? ($deliveredOrders / $totalOrders) * 100 : 0;
$cancellationRate = $totalOrders > 0 ? ($canceledOrders / $totalOrders) * 100 : 0;
$orders=Order::select('id','full_name','number','grand_total','payment_status','delivery_status','created_at')->latest()->limit(5)->get();
$reviews=Review::with('user')->latest()->limit(5)->get();
        return view('admin.dashboard',compact('totalOrders','totalCancelledOrders','totalRevenue','deliveryRate','cancellationRate','orders','reviews'));
    }
}
