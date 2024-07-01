<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        $bestSeller=Product::with('subCategory')
            ->whereHas('subCategory',function($query){
                $query->whereRaw('LOWER(title)=?',['best seller']);
            })->get();
        return view('index',compact('bestSeller'));
    }
}
