<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AddCategoryController extends Controller
{
    // insetion fucntion of product category
    public function createProductCategory(Request $req){
        $req->validate([
           'title'=>'required|string|max:255',
        ]);

        try{
            $category= new Category();
        $category->title=$req->input('title');
        $category->save();
         return redirect()->route('product.category')->with('success','New product category created !');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error','Failed to create product category !');
        }
    }

    // viewing of product cateogry page
    public function viewProductCategory(){

        $categories=Category::paginate(10);
        return view('admin.category.product-category',compact('categories'));
        
    }
    // deleting of product cateogry by id
    public function update(Request $req){
        $req->validate([
            'editTitle'=>'required|string|max:255',
         ]);
 
         try{
            $category=Category::findOrFail($req->input('id'));
         $category->title=$req->input('editTitle');
         $category->save();
          return redirect()->route('product.category')->with('success','product category Updated !');
         }
         catch(\Exception $e){
             return redirect()->back()->withInput()->with('error','Failed to update product category !');
         }
        }
}
