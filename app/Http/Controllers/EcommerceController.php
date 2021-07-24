<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $newProducts = Product::where('status', Product::STATUS['show'])->orderBy('id', 'desc')->take(24)->get();
        return view('ecommerce.home', compact('categories', 'newProducts'));
    }
    public function seeAllProducts() {
        $products = Product::where('status', Product::STATUS['show'])->orderBy('id', 'desc')->paginate(12);
        return view('ecommerce.all-products', compact('products'));
    }
    public function filterProductAll(Request $request)
    {
        if ($request->filter == 'expensive') {
            $products = Product::where('status', Product::STATUS['show'])->orderBy('price', 'desc')->paginate(12);
        } else {
            $products = Product::where('status', Product::STATUS['show'])->orderBy('price', 'asc')->paginate(12);
        }
        return view('ecommerce.all-products', compact('products'));
    }
}
