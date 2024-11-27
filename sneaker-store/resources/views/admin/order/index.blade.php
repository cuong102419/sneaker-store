@extends('admin.layout.layout')

@section('title')
    Quản lý đơn hàng
@endsection

@section('content')
    <div class="page-inner">
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
                <div class="d-flex justify-content-between">
                    <form action="{{ route('order.index') }}" method="GET" class="d-flex">
                        @csrf
                        <input type="search" name="search" class="form-control" placeholder="Tìm kiếm theo mã đơn.">
                        <button type="submit" class="btn btn-info rounded-3 ms-1">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('order.status') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" id="processing" name="action" value="processing"
                            class="btn btn-sm btn-info me-2">Chốt đơn</button>
                        <button type="submit" id="completed" name="action" value="completed"
                            class="btn btn-sm btn-success me-2">Hoàn thành</button>
                        <button type="submit" id="cancelled" name="action" value="cancelled"
                            class="btn btn-sm btn-danger">Hủy đơn</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-nowrap">
                                            <input type="checkbox" class="form-check-input order-checkbox" name="orderId[]"
                                                value="{{ $order->id }}">
                                        </td>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            <strong>{{ $order->fullname }}</strong>
                                            <div>{{ $order->phone_number }}</div>
                                            <div><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</div>
                                        </td>
                                        <td>
                                            {{ $order->payment_method === 'cod' ? 'Thanh toán khi nhận hàng (COD).' : 'Chuyển khoản ngân hàng.' }}
                                            <div>
                                                Trạng thái: <span
                                                    class="{{ $paymentStatus[$order->payment_status]['class'] }}"><strong>{{ $paymentStatus[$order->payment_status]['value'] }}</strong></span>
                                            </div>
                                        </td>
                                        <td><strong>{{ number_format($order->total_amount, 0, ',', '.') }}đ</strong></td>
                                        <td><strong
                                                class="{{ $status[$order->status]['class'] }}">{{ $status[$order->status]['value'] }}</strong>
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('order.edit', $order->id) }}"
                                                class="btn btn-lg text-primary">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
