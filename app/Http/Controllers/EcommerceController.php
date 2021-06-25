<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('ecommerce.home', compact('categories'));
    }
}
