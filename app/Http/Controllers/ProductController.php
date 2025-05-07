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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
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
//                    $imageName = $request->file('images')->getClientOriginalName();
                    foreach ($request->file('images') as $imageFile) {
                        // Store image in storage/public/images

                        $filePath = $imageFile->store('images', 'public');

                        // Save image details in the images table
                        $img = Image::create([
                            'product_variant_id' => $productVariant->id,
                            'url' => substr($filePath, 7),
                            'is_primary' => true, // Set to true if this is a primary image
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

    public function addToCart(Product $product, Image $image, Request $request){
        // Add product to cart logic here
        // You can use session or database to store the cart items

//        $cart = [];
//        if (!empty($request->cookie('cart'))){
//            $cart = unserialize($request->cookie('cart'));;
//        }
//        // check if the product is already in the cart
//        if(isset($cart[$product->id])) {
//            $cart[$product->id]['quantity']++;
//        }
//        else {
////            dd($product->productVariants);
//            $url = $image->where('product_variant_id', $product->productVariants[0]['id'])->first();
//            $variant = $product->productVariants[0];
//
//            $cart[$product->id] = [
//                "product_id" =>$product->id,
//                "name" => $product->product_name,
//                "quantity" => 1,
//                "price" => $product->base_price,
//                "image" => $url->url,
//                'color_name' =>$variant->color->color_name,
//                'size_name' => $variant->size->size_name,
//            ];
//        }
//        // Save the cart back to the session
////        cookie()->put('cart', $cart);
////        Cookie::queue('cart', $cart, 60 * 24 * 7); // Store for 7 days
////        dd($cart);
//
//        $cookie = cookie('cart', serialize($cart), 60 * 24 * 7); // Store for 7 days
//
//        return redirect()->route('cart')->cookie($cookie);

        //Nếu cart tồn lại trên session thì lấy về, còn chưa thì tạo 1 mảng mới
        $cart = session()->get('cart', []);

//        dd($cart);
        //Kiểm tra trên cart đã có snar phẩm được chọn chưa
        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity']++;
        } else {
            $url = $image->where('product_variant_id', $product->productVariants[0]['id'])->first();
            $variant = $product->productVariants[0];
//            dd($variant);
            $cart[$product->id] = [
                "product_id" =>$product->id,
                "product_variant_id" => $product->productVariants[0]->id,
                "name" => $product->product_name,
                "quantity" => 1,
                "price" => $product->base_price,
                "image" => $url->url,
                'color_name' =>$variant->color->color_name,
                'size_name' => $variant->size->size_name,
            ];
        }
        //Lưu cart lên session
        session()->put('cart', $cart);
//        dd($cart);
        return Redirect::route('cart');
    }
    public function updateCart(Request $request)
    {
//        // Update cart logic here
//        $cart = [];
//        if (!empty($request->cookie('cart'))){
//            $cart = unserialize($request->cookie('cart'));;
//            foreach($request->quantity as $key => $value){
//                $cart[$key]['quantity'] = $value;
//            }
//        }
//        // Update the quantity of the product in the cart
//
//
//        // Save the updated cart back to the session
//        $cookie = cookie('cart', serialize($cart), 60 * 24 * 7); // Store for 7 days
//
//        return redirect()->route('cart')->cookie($cookie);

        //Lấy sản phẩm có id và số lượng muốn cập nhật
//        dd($request);
        $products = $request->quantity;
        //Lấy cart
        $cart = session()->get('cart', []);
//        dd($products);
        foreach ($products as $id => $quantity) {
//            dd($id);
            $cart[$id]['quantity'] = $quantity;
        }
        session()->put('cart', $cart);
        return Redirect::route('cart');
    }

    public function removeProduct(Product $product): \Illuminate\Http\RedirectResponse
    {
        //Lấy cart
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);
        return Redirect::route('cart');
    }

    public function deleteAllProducts(): \Illuminate\Http\RedirectResponse
    {
        //Xóa cart
        session()->forget('cart');
        return Redirect::route('products.remove_cart');
    }

}
