@extends('admin.layout.layout')

@section('title')
    Quản lý đơn hàng
@endsection

@section('content')
    <div class="page-inner">
        <form action="{{ route('order.status') }}" method="post">
            @csrf
            <div class="page-header">
                <h3 class="fw-bold">Đơn hàng</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    @if (session('message'))
                        <div class="alert alert-danger">
                            <strong>{{ session('message') }}</strong>
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-success">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                    <div class="text-end">
                        <button type="submit" id="processing" name="action" value="processing" class="btn btn-sm btn-info">Chốt
                            đơn</button>
                        <button type="submit" id="completed" name="action" value="completed"
                            class="btn btn-sm btn-success">Hoàn thành</button>
                        <button type="submit" id="cancelled" name="action" value="cancelled" class="btn btn-sm btn-danger">Hủy
                            đơn</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="select-all">
                                </th>
                                <th>Mã</th>
                                <th>Khách hàng</th>
                                <th>Phương thức thanh toán</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td style="1px" class="text-nowrap">
                                            <input type="checkbox" class="form-check-input order-checkbox" name="orderId[]"
                                                value="{{ $order->id }}">
                                        </td>
                                        <th>{{ $order->id }}</th>
                                        <td>
                                            <strong>{{ $order->fullname }}</strong>
                                            <div>{{ $order->phone_number }}</div>
                                            <div><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</div>
                                        </td>
                                        <td>
                                            {{ $order->payment_method === 'cod' ? 'Thanh toán khi nhận hàng (COD).' : 'Chuyển khoản ngân hàng.' }}
                                            <div>
                                                Trạng thái: <span
                                                    class="{{ $paymentStatus[$order->payment_status]['class'] }}">{{ $paymentStatus[$order->payment_status]['value'] }}</span>
                                            </div>
                                        </td>
                                        <td><strong>{{ number_format($order->total_amount, 0, ',', '.') }}đ</strong></td>
                                        <td><strong
                                                class="{{ $status[$order->status]['class'] }}">{{ $status[$order->status]['value'] }}</strong>
                                        </td>
                                        <td>{{ date('d-m-Y', $order->create_at) }}</td>
                                        <td>
                                            <a href="{{ route('order.edit', $order->id) }}" class="btn btn-lg text-primary">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
