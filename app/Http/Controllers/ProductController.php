<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
            'name' => $request->name,
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
            'status' => Product::STATUS['show'],
            'price' => $request->price,
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
        $numberOrder = Auth::check() ? Auth::user()->number_order : 0;
        $user = $product->users()->first();
        return view('products.show', compact('product', 'subImageName', 'numberOrder', 'user'));
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
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('message', 'X??a th??nh c??ng');
    }
    public function searchProduct(Request $request)
    {
        $keyword = $request->search;
        $users = User::where('name', 'like', '%' . $keyword . '%')->orWhere('username', 'like', '%' . $keyword . '%')->get();
        $products = Product::where('name', 'like', '%' . $keyword . '%')->where('status', Product::STATUS['show'])->paginate(12);
        return view('ecommerce.search', compact('products', 'keyword', 'users'));
    }
    public function filterProduct(Request $request)
    {
        $category = Category::findOrFail($request->category);
        if ($request->filter == 'expensive') {
            $products = Product::where('status', Product::STATUS['show'])->where('category_id', $category->id)->orderBy('price', 'desc')->paginate(12);
        } else {
            $products = Product::where('status', Product::STATUS['show'])->where('category_id', $category->id)->orderBy('price', 'asc')->paginate(12);
        }
        return view('ecommerce.shop', compact('products', 'category'));
    }
}
