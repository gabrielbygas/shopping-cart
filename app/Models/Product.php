<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock_quantity', 'image_url'];
    protected $casts = [
        'price' => 'decimal:2',
        'stock_quantity' => 'integer',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}