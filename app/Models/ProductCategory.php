<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table="product_categories";
    
    protected $fillable=['title','desc'];
    // If you want to explicitly define timestamps behaviour
    public $timestamps = true;
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
