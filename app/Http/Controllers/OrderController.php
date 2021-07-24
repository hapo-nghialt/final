<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class OrderController extends Controller
{
    public function index()
    {
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $orderCheck = Order::where('product_id', $request->productId)
            ->where('customer_id', Auth::user()->id)
            ->where('deleted_at', null)
            ->where('status', Order::STATUS['ordered'])->first();
        $product = Product::findOrFail($request->productId);
        $shopId = $product->user_id;
        $orderId = 'ORD' . '-' . $request->customerId . '-' . $shopId . '-' . uniqid();
        if ($orderCheck == null) {
            Order::create([
                'product_id' => $request->productId,
                'quantity' => $request->quantity,
                'amount' => $request->amount,
                'status' => Order::STATUS['ordered'],
                'customer_id' => $request->customerId,
                'shop_id' => $shopId,
                'order_id' => $orderId,
            ]);
        } else {
            $orderCheck->update([
                'quantity' => $orderCheck->quantity + $request->quantity,
                'amount' => $orderCheck->amount + $request->amount,
            ]);
        };
        $productImage = asset('storage/products/' . $product->image);
        $productUrl = route('products.show', $request->productId);
        return response()->json([
            'message' => __('message.add_to_cart_success'),
            'productImage' => $productImage,
            'productName' => $product->name,
            'productPrice' => number_format($product->price, 0),
            'productUrl' => $productUrl,
        ]);
    }
    public function show($id)
    {

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
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('message', 'Xóa thành công');
    }
}
