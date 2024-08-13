<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table="carts";

    protected $fillable=['user_id','product_id','quantity'];

       // Define the relationship with the Product model
       public function product()
       {
           return $this->belongsTo(Product::class);
       }
   
       // Define the relationship with the User model
       public function user()
       {
           return $this->belongsTo(User::class);
       }
}
