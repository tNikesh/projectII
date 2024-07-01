<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubCategoryController extends Controller
{
     // insetion fucntion of sub category
     public function createSubCategory(Request $req){
        $req->validate([
           'title'=>'required|string|max:255',
           'desc'=>'nullable|string|max:255',
        ]);

        $category= new SubCategory();
        $category->title=$req->input('title');
        $category->desc=$req->input('desc');
        $category->save();
         return redirect()->route('sub.category');
    }

    // viewing of sub cateogry page
    public function viewSubCategory(){

        $categories=SubCategory::paginate(10);
        return view('admin.category.sub-category',compact('categories'));
        
    }
    // deleting of sub cateogry by id
    public function deleteSubCategory(Request $req){
        try{
            $id=$req->input('deleteId');
            $category=SubCategory::findOrFail($id);
            $category->delete();
            return redirect()->back()->with(['success'=>'Sub category deleted']);
        }
        catch(ModelNotFoundException $e){
            return redirect()->back()->with(['error'=>'sub category not found']);
        }
    }
}
