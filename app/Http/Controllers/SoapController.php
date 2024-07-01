<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SoapController extends Controller
{
    public function view()
    {
         $soaps=Product::with('productCategory')
            ->whereHas('productCategory',function($query){
                $query->whereRaw('LOWER(title)=?',['soap']);
            })->get();
        return view('soap',compact('soaps'));
    }
}
