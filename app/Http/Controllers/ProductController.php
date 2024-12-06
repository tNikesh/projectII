<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\ProductSimilarity;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $productCategories = Category::all();
        return view('admin.product.add-product', compact('productCategories'));
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
            'category' => 'required|array',
            'category.*' => 'exists:category,id',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:1024',
        ]);

        try {
            // handing the image submission
            DB::beginTransaction();
            $images = [];
            if ($req->hasfile('images')) {
                foreach ($req->file('images') as $image) {
                    //renaming the each image 
                    $uniqueImageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    $image->move(public_path('images'), $uniqueImageName);

                    $images[] = $uniqueImageName;
                }
            }
            $product = Product::create([
                'name' => $req->input('name'),
                'desc' => $req->input('desc'),
                'base_price' => $req->input('base_price'),
                'discount' => $req->input('discount'),
                'stock' => $req->input('stock'),
                'image_1' => $images[0] ?? null,
                'image_2' => $images[1] ?? null,
                'image_3' => $images[2] ?? null,
                'image_4' => $images[3] ?? null,
            ]);
            // Manually insert the categories into the pivot table
            $categoryIds = $req->input('category');  // Get the selected category IDs from the form

            // Insert each category into the pivot table with the associated product_id
            foreach ($categoryIds as $categoryId) {
                DB::table('product_category')->insert([
                    'product_id' => $product->id,
                    'category_id' => $categoryId,
                ]);
            }
            DB::commit();
            return redirect()->route('view.product')->with('success', 'You have added new product');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', "Failed to add new product !");
        }
    }

    //view all product
    public function view()
    {
        $products = Product::with('category')->latest()->paginate(8);
        return view('admin.product.view-product', compact('products'));
    }



    // show product based on category
    public function show($id)
    {
        // Fetch the category by ID
        $category = Category::findOrFail($id);
        // Get the search query from the request
        $search = request('search');
        $products = $category->product() // Access the many-to-many relationship
            ->with(['review']) // Eager load reviews
            ->withAvg('review as avg_rating', 'ratings') // Calculate average rating
            ->orderByDesc('avg_rating') // Order products by average rating
            ->when($search, function ($query) use ($search) {
                // If there's a search query, filter products by name or other fields
                $query->where('name', 'like', "{$search}%")
                    ->orWhere('desc', 'like', "{$search}%"); // Adjust for other fields
            })
            ->paginate(8);
        // Pass both the category and the paginated products to the view
        return view('products', compact('category', 'products'));
    }
    // single product page
    public function showSingleProduct($id)
    {
        try {
            $product = Product::with(['category', 'review.user'])->withAvg('review as avg_rating', 'ratings')->findOrFail($id);
            $images = [];
            if ($product->image_1) {
                $images[] = $product->image_1;
            }
            if ($product->image_2) {
                $images[] = $product->image_2;
            }
            if ($product->image_3) {
                $images[] = $product->image_3;
            }
            if ($product->image_4) {
                $images[] = $product->image_4;
            }
            $products = Product::with('category')->get();

            $productSimilarity = new ProductSimilarity($products);
            $similarityMatrix = $productSimilarity->calculateSimilarityMatrix();
            $similarProducts = $productSimilarity->getProductsSortedBySimularity($product->id, $similarityMatrix);
            return view('product-page', compact('product', 'images', 'similarProducts'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $productCategories = Category::all();
            $product = Product::with('category')->findOrFail($id);
            $selectedCategories = $product->category->pluck('id')->toArray();
            return view('admin.product.edit-product', compact('product', 'productCategories', 'selectedCategories'));
        } catch (Exception $e) {
            return redirect()->route('view.product')->with('error', 'no product found');
        }
    }
    public function update($id, Request $req)
    {
        $req->validate([
            'name' => 'required|string',
            'desc' => 'nullable|string',
            'base_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'stock' => 'nullable|numeric',
            'category' => 'required|array',
            'category.*' => 'exists:category,id',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:1024',
        ]);

        try {
            // Fetch the product
            $product = Product::with('category')->findOrFail($id);

            DB::beginTransaction();

            // Handle image submission
            $images = [
                $product->image_1,
                $product->image_2,
                $product->image_3,
                $product->image_4,
            ];

            if ($req->hasFile('images')) {
                foreach ($req->file('images') as $index => $image) {
                    $uniqueImageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $uniqueImageName);

                    $images[$index] = $uniqueImageName;
                }
            }

            // Update stock only if a new stock value is provided
            $newStock = $req->input('stock') !== null
                ? $product->stock + $req->input('stock')
                : $product->stock;

            // Update product details
            $product->update([
                'name' => $req->input('name'),
                'desc' => $req->input('desc'),
                'base_price' => $req->input('base_price'),
                'discount' => $req->input('discount'),
                'stock' => $newStock,
                'image_1' => $images[0],
                'image_2' => $images[1],
                'image_3' => $images[2],
                'image_4' => $images[3],
            ]);

            // Update categories in the pivot table
            $categoryIds = $req->input('category');
            $product->category()->sync($categoryIds);

            DB::commit();

            return redirect()->route('view.product')->with('success', 'You have updated the product successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', "Failed to update the product!");
        }
    }
}
