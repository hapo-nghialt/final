<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Follow;
use App\Models\Notification;
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
        $products = Product::where('user_id', $id)->where('status', Product::STATUS['show'])->get();
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
    
    public function destroy($id)
    {
        //
    }
}
