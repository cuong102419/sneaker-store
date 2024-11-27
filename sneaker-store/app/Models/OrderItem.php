<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function productVariant(){
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}