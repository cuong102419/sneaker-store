@extends('admin.layout.layout')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold">Chi tiết đơn hàng</h3>
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
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th colspan="2">SẢN PHẨM</th>
                            <th>TỔNG</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($orderItem as $item)
                                <tr>
                                    <td class="text-nowrap" style="width:1px">
                                        <img src="{{ Storage::url($item->product->image) }}" width="100" alt="">
                                    </td>
                                    <td>
                                        {{ $item->product->name }}
                                        <div class="mt-2">
                                            <strong>
                                                Kích thước:
                                            </strong>
                                            {{ $item->productVariant->size->size }}
                                        </div>
                                        <div>
                                            <strong>
                                                Số lượng:
                                            </strong>
                                            {{ $item->quantity }}
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->subtotal, 0, ',', '.') }} <u>đ</u></strong>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Phương thức thanh toán:
                                </th>
                                <td>
                                    {{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng (COD)' : 'Chuyển khoản ngân hàng.' }}
                                    <div>
                                        Trạng thái: <span
                                            class="{{ $paymentStatus[$order->payment_status]['class'] }}">{{ $paymentStatus[$order->payment_status]['value'] }}</span>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('order.paymentStatus', $order->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <select name="payment_status" id="" class="form-select">
                                            <option disabled selected>--Chọn--</option>
                                            <option value="paid"
                                                {{ $order->payment_status == 'paid' ? 'disabled' : '' }}>Đã
                                                thanh toán</option>
                                            <option value="refunded"
                                                {{ $order->payment_status == 'refunded' ? 'disabled' : '' }}>Hoàn tiền
                                            </option>
                                        </select>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    Tổng cộng:
                                </th>
                                <td>
                                    <strong>{{ number_format($order->total_amount, 0, ',', '.') }} <u>đ</u></strong>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <h5 class="fw-bold">Thông tin khách hàng</h5>
                    <form action="" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">Họ và tên</label>
                                <input type="text" name="fullname" class="form-control" required
                                    value="{{ $order->fullname }}" placeholder="Nhập họ tên khách hàng">
                                @error('fullname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="" class="form-label">Số điện thoại</label>
                                <input type="text" name="phone_number" class="form-control"
                                    value="{{ $order->phone_number }}" required placeholder="Nhập số điện thoại">
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Địa chỉ</label>
                            <input type="text" name="shipping_address" class="form-control"
                                value="{{ $order->shipping_address }}" required placeholder="Nhập địa chỉ">
                            @error('shipping_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Ghi chú đơn hàng</label>
                            <textarea name="" disabled id="" class="form-control" rows="3">{{ $order->customer_notes == null ? 'Trống' : $order->customer_notes }}</textarea>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-sm btn-primary">Cập nhật thông tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
