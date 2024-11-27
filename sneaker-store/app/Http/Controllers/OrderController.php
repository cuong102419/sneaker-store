<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        try {
            $cart = session('cart', []);
        $data = $request->validate([
            'fullname' => ['required'],
            'phone_number' => ['required', 'max:15', 'min:10'],
            'shipping_address' => ['required'],
            'customer_notes' => ['nullable'],
            'payment_method' => ['required'],
            'total_amount' => ['required'],
        ]);

        if (Auth::user()) {
            $data['user_id'] = Auth::user()->id;
        }

        if ($cart) {
            $order = Order::query()->create($data);
            foreach ($cart as $item) {
                $item['order_id'] = $order->id;

                OrderItem::query()->create($item);
                Product::findOrFail($item['product_id'])->increment('sales_count');
            }

            session()->forget('cart');
        }

        return redirect()->route('showOrder', $order->id)->with('message', 'Cảm ơn bạn. Đơn hàng đã được nhận.');

        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function showOrder($orderId)
    {
        try {
            $order = Order::query()->findOrFail($orderId);
            $orderItem = OrderItem::where('order_id', $orderId)->get();
            
            return view('client.order.show', compact('order', 'orderItem'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Không tìm thấy đơn hàng.');
        }
    }
}
