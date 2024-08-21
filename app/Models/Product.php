<?php

namespace App\Models;

use App\Models\SubCategory;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'desc', 'base_price', 'stock', 'discount', 'category_id', 'image_1','image_2','image_3','image_4'
    ];

    
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function oderItem(){
        return $this->hasMany(OrderItem::class);
    }
    public function review(){
        return $this->hasMany(Review::class);
    }
    public function updateStock()
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
}
