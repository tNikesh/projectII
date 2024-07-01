<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AddCategoryController extends Controller
{
    // insetion fucntion of product category
    public function createProductCategory(Request $req){
        $req->validate([
           'title'=>'required|string|max:255',
           'desc'=>'nullable|string|max:255',
        ]);

        $category= new ProductCategory();
        $category->title=$req->input('title');
        $category->desc=$req->input('desc');
        $category->save();
         return redirect()->route('product.category');
    }

    // viewing of product cateogry page
    public function viewProductCategory(){

        $categories=ProductCategory::paginate(10);
        return view('admin.category.product-category',compact('categories'));
        
    }
    // deleting of product cateogry by id
    public function deleteProductCategory(Request $req){
        try{
            $id=$req->input('deleteId');
            $category=ProductCategory::findOrFail($id);
            $category->delete();
            return redirect()->back()->with(['success'=>'Product category deleted']);
        }
        catch(ModelNotFoundException $e){
            return redirect()->back()->with(['error'=>'category not found']);
        }
    }
}
