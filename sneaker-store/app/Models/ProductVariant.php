<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'size_id',
        'quantity',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function size() {
        return $this->belongsTo(Size::class);
    }
}