<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'status',
        'total_amount',
        'payment_status',
        'payment_method',
        'shipping_address',
        'customer_notes',
        'phone_number',
        'fullname',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
