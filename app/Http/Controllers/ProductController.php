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
        return view('admin.product.add-product',compact('productCategories'));
    }

    // add product
    public function create(Request $req)
    {
        $req->validate([
            'name' => 'required|string',
            'desc' => 'nullable|string',
            'base_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'stock' => 'required|numeric',
            'category' => 'required|exists:product_categories,id',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:1024',
        ]);

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
                'category_id'=>$req->input('category'),
                'image_1' => $images[0] ?? null,
                'image_2' => $images[1] ?? null,
                'image_3' => $images[2] ?? null,
                'image_4' => $images[3] ?? null,
            ]);
            return redirect()->route('view.product')->with('success','You have added new product');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',"Failed to add new product !");
        }
    }

    //view all product
    public function view(){
        $products=Product::with('productCategory:id,title')->paginate(10);
        // dd($products);
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
        $product=Product::with(['productCategory','review'])->findOrFail($id);
        try{
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