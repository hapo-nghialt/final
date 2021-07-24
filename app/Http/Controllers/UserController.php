<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UsersFollowProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
        $products = Product::where('user_id', $id)->where('status', Product::STATUS['show'])->orderBy('id', 'desc')->paginate(6);
        $idProductsFollow = UsersFollowProducts::where('user_id', Auth::id())->get();
        $productsFollow = [];
        if (isset($idProductsFollow)) {
            foreach ($idProductsFollow as $item) {
                $idProduct = $item->product_id;
                $product = Product::findOrFail($idProduct);
                array_push($productsFollow, $product);
            }
        }
        $followings = [];
        $idFollowing = Follow::where('follower_id', Auth::id())->get();
        if (isset($idFollowing)) {
            foreach ($idFollowing as $item) {
                $idFollowing = $item->following_id;
                $following = User::findOrFail($idFollowing);
                array_push($followings, $following);
            }
        }
        $user = User::findOrFail($id);
        $categories = Category::get();
        return view('users.show', compact('categories', 'products', 'user', 'productsFollow', 'followings'));
    }
    public function showCart()
    {
        $user = Auth::user();
        $orders = $user->orders()->orderBy('created_at', 'desc')->where('status', Order::STATUS['ordered'])->get();
        $amount = 0;
        foreach ($orders as $order) {
            $amount = $amount + $order->amount;
        }
        return view('ecommerce.cart', compact('orders', 'amount'));
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request)
    {
        $avatar = null;
        $user = User::findOrFail(Auth::user()->id);
        if ($request->hasFile('avatar')) {
            $avatar = uniqid() . "_" . $request->avatar->getClientOriginalName();
            $request->file('avatar')->storeAs('public/avatars', $avatar);
            $user->update([
               'avatar' => $avatar,
            ]);
        }
        $user->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);
        return redirect()->route('users.show', Auth::user()->id)->with('message', 'Cập nhật thông tin thành công');
    }
    public function follow(Request $request)
    {
        $user = User::findOrFail($request->followingId);
        $follower = $user->follower;
        Follow::create([
            'follower_id' => Auth::user()->id,
            'following_id' => $user->id,
        ]);
        Notification::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $user->id,
            'content' => Auth::user()->name . ' (' . Auth::user()->username . ') ' . 'đã theo dõi bạn.',
        ]);
        $user->update([
            'follower' => $follower + 1,
        ]);
    }
    public function unfollow(Request $request)
    {
        $user = User::findOrFail($request->followingId);
        $follower = $user->follower;
        Follow::where('follower_id', Auth::user()->id)->where('following_id', $user->id)->delete();
        Notification::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $user->id,
            'content' => Auth::user()->name . ' (' . Auth::user()->username . ') ' . 'đã bỏ theo dõi bạn.',
        ]);
        $user->update([
            'follower' => $follower - 1,
        ]);
    }
    public function manageOrders($id) {
        $orders = Auth::user()->manageOrders()->get()->groupBy('customer_id');
        return view('ecommerce.order', compact('orders'));
    }
    public function followProduct(Request $request) {
        $userId = $request->userId;
        $productId = $request->productId;
        if (UsersFollowProducts::where('user_id', $userId)->where('product_id', $productId)->first() == null) {
            UsersFollowProducts::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
        } else {
            UsersFollowProducts::where('user_id', $userId)->where('product_id', $productId)->delete();
        }
    }
    public function buyProduct(Request $request)
    {
        foreach ($request->orderId as $item) {
            $order = Order::findOrFail($item);
            $orderPaymentId = $order->order_id;
            $order->update([
               'status' => Order::STATUS['paid'],
            ]);
        };
        $time = Carbon::now()->format('H:m:s d/m/y');
        Notification::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => Auth::user()->id,
            'content' => 'Bạn đã thanh toán thành công cho đơn hàng ' . $orderPaymentId . ' (' . $time . ')',
        ]);
        $message = 'Thanh toán thành công!';
        return view('ecommerce.cart-empty', compact('message'));
    }
    public function destroy($id)
    {
        //
    }
}
