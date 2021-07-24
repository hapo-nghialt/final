<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
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
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('message', 'Xóa thành công');
    }
    public function updateStatus($id)
    {
        $product = Product::findOrFail($id);
        $user = $product->users()->first();
        if ($product->status == Product::STATUS['hide']) {
            $product->update([
                'status' => Product::STATUS['show'],
            ]);
            Notification::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $user->id,
                'content' => 'Sản phẩm của bạn (' . $product->name . ') đã được hiển thị trở lại!',
            ]);
        } else {
            Notification::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $user->id,
                'content' => 'Sản phẩm của bạn (' . $product->name . ') đã tạm thời bị admin ẩn!',
            ]);
            $product->update([
                'status' => Product::STATUS['hide'],
            ]);
        }
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }
}
