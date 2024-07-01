<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    public function index(){
        $productCategories=ProductCategory::all();
        $subCategories=SubCategory::all();
        return view('admin.product.add-product',compact('productCategories','subCategories'));
    }

    // add product
    public function create(Request $req)
    {
        try{
            // handing the image submission
            $images=[];
            if($req->hasfile('images')){
                foreach($req->file('images') as $image){
                    //renaming the each image 
                    $uniqueImageName=time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

                    $image->move(public_path('images'),$uniqueImageName);

                    $images[]=$uniqueImageName;

                }
            }

            Product::create([
                'name'=>$req->input('name'),
                'desc'=>$req->input('desc'),
                'base_price'=>$req->input('base_price'),
                'discount'=>$req->input('discount'),
                'stock'=>$req->input('stock'),
                'category_id'=>$req->input('subCategory'),
                'sub_category_id'=>$req->input('category'),
                'image_1' => $images[0] ?? null,
                'image_2' => $images[1] ?? null,
                'image_3' => $images[2] ?? null,
                'image_4' => $images[3] ?? null,
            ]);
            return redirect()->route('view.product');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    //view all product
    public function view(){
        $products=Product::with(['subCategory','productCategory'])->paginate(10);
        return view('admin.product.view-product',compact('products'));
    }

    //delete product by id
    public function destroy(Request $req){
        $id=$req->input('deleteId');
        try{
            $product=Product::findOrFail($id);
            $product->delete();
            return redirect()->back()->with('success','Product Deleted Successfully');
        }
        catch(ModelNotFoundException $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    // single product page
    public function showSingleProduct( $id){
        try{
            $product=Product::with(['subCategory','productCategory'])->findOrFail($id);

            $images=[];
            if($product->image_1){
                $images[]=$product->image_1;
            }
            if($product->image_2){
                $images[]=$product->image_2;
            }
            if($product->image_3){
                $images[]=$product->image_3;
            }
            if($product->image_4){
                $images[]=$product->image_4;
            }

            return view('product-page',compact('product','images'));
        }
        catch(ModelNotFoundException $e){{
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
}