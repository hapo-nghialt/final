<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.user')->only('create', 'store');
    }

    public function index()
    {
        //
    }
    public function create()
    {
        $categories = Category::get();
        return view('products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = uniqid() . "_" . $request->image->getClientOriginalName();
            $request->file('image')->storeAs('public/products', $image);
        }
        $subImages = $request->subImages;
        foreach ($subImages as $key => $image) {
            $subImage = uniqid() . "_" . $image->getClientOriginalName();
            $image->storeAs('public/products', $subImage);
        }
        Product::create([
            'title' => $request->title,
            'status' => $request->status,
            'description' => $request->description,
            'image' => $image,
            'image_1' => $nameImageArray[0],
            'image_2' => $nameImageArray[1],
            'image_3' => $nameImageArray[2],
            'image_4' => $nameImageArray[3],
            'image_5' => $nameImageArray[4],
            'image_6' => $nameImageArray[5],
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'address' => $request->address,
            'price' => $request->price,
            'show_status' => 1,
            'bought_status' => 0,
        ]);

        return redirect()->route('users.show', Auth::user()->id);
    }
    public function show($id)
    {
        //
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
