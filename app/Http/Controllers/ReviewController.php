<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Request $req, $id)
    {
        $product = Product::findOrFail($id);
        $req->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => ['nullable', 'string', 'max:500', 'regex:/^\b(\w+\b[\s\r\n]*){1,100}$/'],
        ], [
            'review.regex' => 'The review must not exceed 100 words.',
        ]);
        try {
            Review::create([
                'product_id' => $product->id,
                'ratings' => $req->input('rating'),
                'reviews' => $req->input('review'),
                'customer_name' => Auth::user()->name,
            ]);
            return back()->with('success', 'Review submitted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to submit review!');
        }
    }
}