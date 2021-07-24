<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'follower',
        'email_verified_at', 'role_id', 'phone_number', 'address', 'avatar', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ROLE = [
        'admin' => 0,
        'user' => 1,
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function orders() {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function manageOrders() {
        return $this->hasMany(Order::class, 'shop_id');
    }

    public function getCreatedDateFormat()
    {
        $createdAt = Carbon::parse($this->created_at)->format('d-m-Y');
        return $createdAt;
    }

    public function getNumberItemAttribute()
    {
        return $this->products()->where('status', Product::STATUS['show'])->count();
    }

    public function getNumberOrderAttribute()
    {
        return $this->orders()->where('status', Order::STATUS['ordered'])->count();
    }

    public function isFollowing($id) {
        $follower = Follow::where('follower_id', Auth::id())->where('following_id', $id)->first();
        return (isset($follower));
    }

    public function getLastMessage($id)
    {
        $user_id = Auth::id();
        $lastMessage = Message::where(function ($query) use ($id, $user_id) {
            $query->where('from', $user_id)->where('to', $id);
        })->orWhere(function ($query) use ($id, $user_id) {
            $query->where('from', $id)->where('to', $user_id);
        })->orderBy('id', 'desc')->first();
        if (isset($lastMessage)) {
            return $lastMessage->message;
        }
        return null;
    }
}
