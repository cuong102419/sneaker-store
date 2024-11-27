@extends('client.layout.layout')

@section('title')
    Đơn hàng
@endsection

@section('content')
    <div class="container">
        <div>
            @if ($orders->isEmpty())
                <div style="height: 500px">
                    <h4 class="fst-italic mt-5 text-center">Chưa có đơn hàng nào.</h4>
                </div>
            @else
                <div>
                    <h3 class="text-uppercase text-center mt-5">Đơn hàng của bạn</h3>
                    <table class="table mt-5 mb-5">
                        <thead class="text-center">
                            <th>Mã đơn hàng</th>
                            <th>Ngày</th>
                            <th>Trạng thái</th>
                            <th>Tổng</th>
                            <th>Thao tác</th>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($orders as $order)
                                <tr>
                                    <th>#{{ $order->id }}</th>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td><strong
                                            class="{{ $status[$order->status]['class'] }}">{{ $status[$order->status]['value'] }}</strong>
                                    </td>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                                    <td>
                                        <a href="{{ route('showOrder', $order->id) }}" class="btn btn-sm btn-primary">Xem</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
