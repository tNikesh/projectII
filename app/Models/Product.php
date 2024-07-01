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
        'name', 'desc', 'base_price', 'stock', 'discount', 'category_id', 'sub_category_id','image_1','image_2','image_3','image_4'
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
}