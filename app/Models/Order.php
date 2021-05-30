<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'quantity',
        'amount',
        'status',
        'customer_id',
    ];

    const STATUS=[
        'ordered' => 0,
        'paid' => 1,
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function shops()
    {
        $product = $this->products()->first();
        return (User::where('id', $product->user_id)->first());
    }
}
