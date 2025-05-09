<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Material;
use App\Models\Origin;
use App\Models\Product;
use App\Models\Product_variant;
use App\Models\Size;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index( Request $request)
    {
//        $minutes = 60;
//        $response = new Response('Set Cookie');
//        $response->withCookie(cookie('cart', [], $minutes));

//        $value = unserialize($request->cookie('cart'));

        $brands = Brand::all();
        $sizes = Size::all();
        $categories = Category::all();
        $products = Product::with('productVariants')->get();
        $variants = Product_variant::with('product', 'images')->paginate(6);
        return view('shop.content.index',[
            'brands' => $brands,
            'sizes' => $sizes,
            'categories' => $categories,
            'products' => $products,
            'variants' => $variants,
        ]);
    }

    public function productDetail(Product $product){
        $title = 'Product Detail';
        //get categories, brands, materials, origins from database
        $categories = Category::all();
        $brands = Brand::all();
        $materials = Material::all();
        $origins = Origin::all();
        //get colors, sizes, images from database
        $colors = Color::all();
        $sizes = \App\Models\Size::all();

        //get product_variant from database
        $variants = $product->productVariants()->with(['color', 'size', 'images'])->paginate(3);

        return view('shop.content.product-details', [
            'title' => $title,
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


    public function shop(){
        //get brand
        $brands = Brand::all();
        $sizes = Size::all();
        $categories = Category::all();
        //get all products
         $products = Product::with('productVariants')->get();
        //get all products with variants
        $variants = Product_variant::with('product', 'images')->paginate(9);
//         dd($products);
//         dd($variants);
        return view('shop.content.shop', [
            'brands' => $brands,
            'sizes' => $sizes,
            'categories' => $categories,
            'products' => $products,
            'variants' => $variants,
        ]);
    }
    public function cart(Request $request){
//        $value = unserialize($request->cookie('cart'));
        $value= $request->session()->get('cart');
        return view('shop.content.cart', [
            'cart' => $value,
        ]);

    }

}
