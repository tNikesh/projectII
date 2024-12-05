<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    
    protected $table="product_category";
    
    protected $fillable=['product_id','category_id'];
    // If you want to explicitly define timestamps behaviour
    public $timestamps = true;
}
