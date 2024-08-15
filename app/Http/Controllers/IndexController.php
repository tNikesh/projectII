<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(RecommendationService $recommendationService){

        $bestSeller=Product::with('productCategory')
            ->whereHas('productCategory',function($query){
                $query->whereRaw('LOWER(title)=?',['soap']);
            })->get();
            $recommendedProducts = $recommendationService->generateRecommendations();
        return view('index',compact('bestSeller','recommendedProducts'));
    }
}
