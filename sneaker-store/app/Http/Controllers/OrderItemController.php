<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function pay() {
        $cart = session('cart', []);
        $total_amount = 0;

        foreach($cart as $item) {
            $total_amount += $item['subtotal'];
        }
        return view('client.pay.pay', compact('total_amount'));
    }
}
