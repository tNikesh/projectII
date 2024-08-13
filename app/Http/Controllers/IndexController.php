<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        $bestSeller=Product::with('productCategory')
            ->whereHas('productCategory',function($query){
                $query->whereRaw('LOWER(title)=?',['soap']);
            })->get();
        return view('index',compact('bestSeller'));
    }
}
