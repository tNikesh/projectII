<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FaceController extends Controller
{
    public function view()
    {
         $faces=Product::with('productCategory')
            ->whereHas('productCategory',function($query){
                $query->whereRaw('LOWER(title)=?',['face']);
            })->get();
        return view('face',compact('faces'));
    }
}
