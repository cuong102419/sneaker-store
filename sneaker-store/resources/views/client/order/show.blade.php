@extends('client.layout.layout')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="mt-4 border shadow w-75">
                @if (session('message'))
                    <h5 class="text-center mt-3 text-success text-uppercase">{{ session('message') }}</h5>
                @endif
                <ul class="mt-3">
                    <li class="mb-2">
                        Mã đơn hàng: <strong>{{ $order->id }}</strong>
                    </li>
                    <li class="mb-2">
                        Ngày tạo: <strong>{{ date('d-m-Y', $order->create_at) }}</strong>
                    </li>
                    <li class="mb-2">
                        Tổng cộng: <strong>{{ number_format($order->total_amount, 0, ',', '.') }} <u>đ</u></strong>
                    </li>
                    <li>
                        Phương thức thanh toán:
                        <strong>{{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng (COD)' : 'Chuyển khoản ngân hàng.' }}</strong>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex justify-content-center mb-5 mt-3">
            <div class="mt-4 w-75">
                <h4 class="ms-2"><strong>Chi tiết đơn hàng</strong></h4>
                <table class="table">
                    <thead>
                        <th>SẢN PHẨM</th>
                        <th class="text-end">TỔNG</th>
                    </thead>
                    <tbody>
                        @foreach ($orderItem as $item)
                            <tr>
                                <td>
                                    {{ $item->product->name }} 
                                    <strong>x
                                        {{ $item->quantity }}
                                    </strong>
                                    <div class="mt-2">
                                        <strong>Kích thước: </strong>{{ $item->productVariant->size->size }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <strong>{{ number_format($item->subtotal, 0, ',', '.') }} <u>đ</u></strong>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>
                                Phương thức thanh toán:
                            </th>
                            <td class="text-end">
                                {{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng (COD)' : 'Chuyển khoản ngân hàng.' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tổng cộng:
                            </th>
                            <td class="text-end">
                                <strong>{{ number_format($order->total_amount, 0, ',', '.') }} <u>đ</u></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
