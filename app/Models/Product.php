<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'description',
        'image',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'user_id',
        'category_id',
        'status',
        'address',
        'price'
    ];

    const STATUS = [
        'hide' => 0,
        'show' => 1,
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getNameCategoryAttribute()
    {
        return $this->categories->name;
    }

    public function getNameShopAttribute()
    {
        return $this->users->name;
    }

    public function checkIfUserFollowProduct() {
        if (UsersFollowProducts::where('product_id', $this->id)->where('user_id', Auth::id())->first() != null) {
            return true;
        }
        return false;
    }
}
