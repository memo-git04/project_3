<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_variant;
use App\Models\Size;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('shop.content.index');
    }


    public function shop(){
        //get brand
        $brands = Brand::all();
        $sizes = Size::all();
        $categories = Category::all();
        //get all products
         $products = Product::with('productVariants')->get();
        //get all products with variants
        $variants = Product_variant::with('product', 'images')->get();
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
    public function cart(){
        return view('shop.content.cart');
    }
}
