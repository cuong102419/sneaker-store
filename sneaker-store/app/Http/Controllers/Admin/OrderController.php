<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $orders = Order::when($search, function($query, $search) {
            return $query->where('id', 'like', '%' . $search . '%');
        })->latest('id')->paginate(8);
        $status = [
            'pending' => ['value' => 'Chờ xử lý', 'class' => 'text-warning'],
            'processing' => ['value' => 'Đang xử lý', 'class' => 'text-primary'],
            'completed' => ['value' => 'Hoàn thành', 'class' => 'text-success'],
            'cancelled' => ['value' => 'Hủy đơn', 'class' => 'text-danger'],
        ];
        $paymentStatus = [
            'paid' => ['value' => 'Đã thanh toán', 'class' => 'text-success'],
            'unpaid' => ['value' => 'Chưa thanh toán', 'class' => 'text-info'],
            'refunded' => ['value' => 'Hoàn trả', 'class' => 'text-warning'],
        ];
        return view('admin.order.index', compact('orders', 'status', 'paymentStatus'));
    }

    public function status(Request $request)
    {
        $orderId = $request->input('orderId', []);

        if (empty($request->input('orderId'))) {
            return redirect()->back()->with('message', 'Không có đơn nào được chọn.');
        }

        $orders = Order::whereIn('id', $orderId)->get();

        if ($request->input('action') === 'processing') {
            foreach ($orders as $order) {
                $order->status = 'processing';
                $order->save();
            }
            return redirect()->back()->with('success', 'Cập nhật thành công.');
        }
        if ($request->input('action') === 'completed') {
            foreach ($orders as $order) {
                $order->status = 'completed';
                $order->save();
            }
            return redirect()->back()->with('success', 'Cập nhật thành công.');
        }
        if ($request->input('action') === 'cancelled') {
            foreach ($orders as $order) {
                $order->status = 'cancelled';
                $order->save();
            }
            return redirect()->back()->with('success', 'Cập nhật thành công.');
        }
    }

    public function edit(Request $request, Order $order) {
        $orderItem = OrderItem::where('order_id', $order->id)->get();
        $paymentStatus = [
            'paid' => ['value' => 'Đã thanh toán', 'class' => 'text-success'],
            'unpaid' => ['value' => 'Chưa thanh toán', 'class' => 'text-primary'],
            'refunded' => ['value' => 'Hoàn trả', 'class' => 'text-warning'],
        ];
        return view('admin.order.edit', compact('orderItem', 'order', 'paymentStatus'));
    }

    public function paymentStatus(Request $request, Order $order) {
        if($request['payment_status']) {
            $order->payment_status = $request->payment_status;
            $order->save();
            
            return redirect()->back()->with('success', 'Cập nhật thành công.');
        }

        return redirect()->back()->with('message', 'Không có trạng thái nào được chọn.');
    }

    public function update(Request $request, Order $order) {
        $data = $request->validate([
            'fullname' => ['required', 'min:2'],
            'phone_number' => ['required', 'min:9', 'max:15'],
            'shipping_address' => ['required', 'min:4'],
        ]);
        $order->update($data);
        return redirect()->back()->with('success', 'Cập nhật thành công.');
    }
}
