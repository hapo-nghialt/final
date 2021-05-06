<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'description',
        'user_id',
        'category_id',
        'show_status',
        'bought_status',
        'address',
        'price'
    ];
}
