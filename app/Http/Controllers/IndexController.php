<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(RecommendationService $recommendationService){

        $crousels=Product::latest()->take(3)->get();
        $review=Review::with(['user:id,name'])->orderBy('ratings','desc')->latest()->first();
        $products = Product::with(['review:id,ratings,product_id'])->withAvg('review as avg_rating','ratings')
        ->having('avg_rating', '>=', 1)
        ->orderBy('avg_rating','desc')->latest()->take(5)->get();
        return view('index',compact('crousels','products','review'));
    }
}
