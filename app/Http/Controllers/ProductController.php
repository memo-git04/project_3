<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Material;
use App\Models\Origin;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product_variant;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand', 'material', 'origin'])->get();
        return view('admin.modules.product.index_product', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get categories, brands, materials, origins from database
        $categories = Category::all();
        $brands = Brand::all();
        $materials = Material::all();
        $origins = Origin::all();

        //get colors, sizes, images from database
        $colors = Color::all();
        $sizes = \App\Models\Size::all();
        //$images = \App\Models\Image::all();

        return view('admin.modules.product.add_product', [
            'categories' => $categories,
            'brands' => $brands,
            'materials' => $materials,
            'origins' => $origins,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //save database in form into DB
        //save into products table
        $product = Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'material_id' => $request->material,
            'origin_id' => $request->origin,
            'base_price' => $request->base_price,
            'description' => $request->description
        ]);

        //save into product_variant table
        // Lưu các biến thể sản phẩm
        if ($request->has('variant')) {
            foreach ($request->variant as $variant) {
                $productVariant = Product_variant::create([
                    'product_id'=>$product->id,
                    'color_id' => $variant['color'],
                    'size_id' => $variant['size'],
                    'stock_quantity' => $variant['quantity'],
                    'price' => $variant['price'],
                ]);
                // Handle image uploads for this product variant
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $imageFile) {
                        // Store image in storage/public/images
                        $filePath = $imageFile->store('images', 'public');

                        // Save image details in the images table
                        $img = Image::create([
                            'product_variant_id' => $productVariant->id,
                            'url' => $filePath,
                            'is_primary' => false, // Set to true if this is a primary image
                            'is_deleted' => false,
                        ]);
//                        dd($img);
                    }
                }
            }
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //get categories, brands, materials, origins from database
        $categories = Category::all();
        $brands = Brand::all();
        $materials = Material::all();
        $origins = Origin::all();
        //get colors, sizes, images from database
        $colors = Color::all();
        $sizes = \App\Models\Size::all();

        //get product_variant from database
        $variants = $product->productVariants()->with(['color', 'size', 'images'])->get();

        return view('admin.modules.product.product_item', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'materials' => $materials,
            'origins' => $origins,
            'colors' => $colors,
            'sizes' => $sizes,
            'variants' => $variants,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        //get categories, brands, materials, origins from database
        $categories = Category::all();
        $brands = Brand::all();
        $materials = Material::all();
        $origins = Origin::all();

        //get colors, sizes, images from database
        $colors = Color::all();
        $sizes = \App\Models\Size::all();
        //$images = \App\Models\Image::all();

        //get product_variant from database
        $variants = $product->productVariants()->with(['color', 'size'])->get();

//        dd($variants);
        return view('admin.modules.product.edit_product', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'materials' => $materials,
            'origins' => $origins,
            'colors' => $colors,
            'sizes' => $sizes,
            'variants' => $variants,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
       // / Update the product details
        $product->update([
            'product_name' => $request->edit_name,
            'category_id' => $request->edit_category,
            'brand_id' => $request->edit_brand,
            'material_id' => $request->edit_material,
            'origin_id' => $request->edit_origin,
            'base_price' => $request->edit_base_price,
            'description' => $request->edit_description
        ]);

        // Update product variants
        if ($request->has('edit_variant')) {
            foreach ($request->edit_variant as $variant) {
                // Search for the variant by ID if available
                $product_variant = Product_variant::find($variant['id'] ?? null);

                if ($product_variant) {
                    // Update existing variant
                    $product_variant->update([
                        'color_id' => $variant['color'],
                        'size_id' => $variant['size'],
                        'stock_quantity' => $variant['quantity'],
                        'price' => $variant['price'],
                    ]);
                } else {
                    // Check if a variant with the same color and size already exists
                    $existing_variant = Product_variant::where('product_id', $product->id)
                        ->where('color_id', $variant['color'])
                        ->where('size_id', $variant['size'])
                        ->first();

                    if (!$existing_variant) {
                        // Create new variant if it doesn't exist
                        Product_variant::create([
                            'product_id' => $product->id,
                            'color_id' => $variant['color'],
                            'size_id' => $variant['size'],
                            'stock_quantity' => $variant['quantity'],
                            'price' => $variant['price'],
                        ]);
                    }
                }
                // Handle image uploads for this product variant
                if ($request->hasFile('edit_images')) {
                    foreach ($request->file('edit_images') as $imageFile) {
                        // Store image in storage/public/images
                        $filePath = $imageFile->store('images', 'public');

                        // Save image details in the images table
                        $img = Image::create([
                            'product_variant_id' => $product_variant->id,
                            'url' => $filePath,
                            'is_primary' => false, // Set to true if this is a primary image
                            'is_deleted' => false,
                        ]);
                    }
                }
            }
        }
        dd($img);
//        return Redirect::back()->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //delete product and product_variant
        $product->productVariants()->delete();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
