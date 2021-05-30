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
        $mainImage = null;
        if ($request->hasFile('image')) {
            $mainImage = uniqid() . "_" . $request->image->getClientOriginalName();
            $request->file('image')->storeAs('public/products', $mainImage);
        }
        $subImages = $request->subImages;
        $subImagesName = [];
        foreach ($subImages as $key => $image) {
            $subImage = uniqid() . "_" . $image->getClientOriginalName();
            array_push($subImagesName, $subImage);
            $image->storeAs('public/products', $subImage);
        }
        for ($i=1; $i<=6; $i++) {
            array_push($subImagesName, null);
        }
        Product::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => html_entity_decode($request->description),
            'image' => $mainImage,
            'image_1' => $subImagesName[0],
            'image_2' => $subImagesName[1],
            'image_3' => $subImagesName[2],
            'image_4' => $subImagesName[3],
            'image_5' => $subImagesName[4],
            'image_6' => $subImagesName[5],
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
        $product = Product::findOrFail($id);
        $subImageName = [
            $product->image_1,
            $product->image_2,
            $product->image_3,
            $product->image_4,
            $product->image_5,
            $product->image_6
        ];
        $numberOrder = Auth::user()->number_order;
        return view('products.show', compact('product', 'subImageName', 'numberOrder'));
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
