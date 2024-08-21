<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $fillable = ['user_id', 'full_name','number' ,'email', 'province', 'district', 'city', 'street', 'delivery_status', 'payment_status', 'grand_total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function grandTotal()
    {

        $grandTotal = 0;
        
        if ($this->orderItem->count() > 0) {

            $grandTotal = $this->orderItem->sum(function ($item) {

                $basePrice = $item->base_price;
                $discount = $item->discount;
                $quantity = $item->quantity;

                $discountedPrice = $basePrice - ($basePrice * ($discount / 100));

                return $discountedPrice * $quantity;
            });
            $grandTotal += config('delivery.delivery_price');
        }
        return $grandTotal;
    }
     
 

    protected static function boot()
    {
        parent::boot();

  

        // When an order is updated to "canceled"
        static::updating(function ($order) {
            if ($order->isDirty('delivery_status') && $order->delivery_status == 'cancelled') {
                DB::transaction(function () use ($order) {
                    foreach ($order->orderItem as $item) {
                        $product = $item->product;
                        $quantity = $item->quantity;

                        // Increase stock back
                        $product->increment('stock', $quantity);
                    }
                });
            }
            if ($order->isDirty('delivery_status') && $order->getOriginal('delivery_status') == 'cancelled' && $order->delivery_status != 'cancelled') {
                DB::transaction(function () use ($order) {
                    foreach ($order->orderItem as $item) {
                        $product = $item->product;
                        $quantity = $item->quantity;

                        // Increase stock back
                        $product->decrement('stock', $quantity);
                    }
                });
            }
        });
    }
}
