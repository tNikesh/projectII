<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Exception;
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
                'user_id' => Auth::id(),
            ]);
            return back()->with('success', 'Review submitted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to submit review!');
        }
    }

    public function view(){
        $reviews=Review::with('user')->latest()->paginate(8);
        return view('admin.review',compact('reviews'));
    }

    public function destroy($id){
        try{
            $review=Review::findOrFail($id);
            $review->delete();
            return redirect()->back()->with('success','Review deleted');
        }
        catch(Exception $e){
            return redirect()->back()->with('error',' failed, Review not deleted');

        }
    }
}
