<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
        $orderCheck = Order::where('product_id', $request->productId)
            ->where('customer_id', Auth::user()->id)
            ->where('status', Order::STATUS['ordered'])->first();
        if ($orderCheck == null) {
            Order::create([
                'product_id' => $request->productId,
                'quantity' => $request->quantity,
                'amount' => $request->amount,
                'status' => Order::STATUS['ordered'],
                'customer_id' => $request->customerId,
            ]);
        } else {
            $orderCheck->update([
                'quantity' => $orderCheck->quantity + $request->quantity,
                'amount' => $orderCheck->amount + $request->amount,
            ]);
        };
        $product = Product::findOrFail($request->productId);
        $productImage = asset('storage/products/' . $product->image);
        return response()->json([
            'message' => __('message.add_to_cart_success'),
            'productImage' => $productImage,
            'productTitle' => $product->title,
            'productPrice' => number_format($product->price, 0),
        ]);
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
