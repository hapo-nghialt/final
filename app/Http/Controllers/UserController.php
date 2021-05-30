<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        $products = Product::where('user_id', $id)->get();
        $user = User::findOrFail($id);
        $categories = Category::get();
        return view('users.show', compact('categories', 'products', 'user'));
    }
    public function showCart()
    {
        $user = Auth::user();
        $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        return view('ecommerce.cart', compact('orders'));
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
