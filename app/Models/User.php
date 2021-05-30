<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function getCreatedDateFormat()
    {
        $createdAt = Carbon::parse($this->created_at)->format('d-m-Y');
        return $createdAt;
    }

    public function getNumberItemAttribute()
    {
        return $this->products()->count();
    }

    public function getNumberOrderAttribute()
    {
        return $this->orders()->count();
    }
}
