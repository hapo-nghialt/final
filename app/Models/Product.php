<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'description',
        'image',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'user_id',
        'category_id',
        'show_status',
        'bought_status',
        'address',
        'price'
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
