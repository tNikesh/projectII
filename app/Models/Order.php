<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

                $basePrice = $item->product->base_price;
                $discount = $item->product->discount;
                $quantity = $item->quantity;

                $discountedPrice = $basePrice - ($basePrice * ($discount / 100));

                return $discountedPrice * $quantity;
            });
            $grandTotal += config('delivery.delivery_price');
        }
        return $grandTotal;
    }
}