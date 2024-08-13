<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table="reviews";
    protected $fillable=['product_id','customer_name','ratings','reviews'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
