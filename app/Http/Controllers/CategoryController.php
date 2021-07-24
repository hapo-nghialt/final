<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showProduct($id)
    {
        $category = Category::where('id', $id)->first();
        $products = Product::where('status', Product::STATUS['show'])->where('category_id', $id)->paginate(12);
        return view('ecommerce.shop', compact('products', 'category'));
    }
}
