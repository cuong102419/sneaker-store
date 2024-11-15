@extends('client.layout.layout')

@section('title')
    Thanh toán
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <div>
            @if (session('message'))
                <script>
                    alert("{{ session('message') }}");
                </script>
            @endif
        </div>
        @if (session('cart'))
            <form action="{{ route('createOrder') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <h5 class="text-uppercase">Thông tin thanh toán</h5>

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="" class="form-label"><b>Họ và tên*</b></label>
                                <input type="text" name="fullname" class="form-control" required
                                    placeholder="Nhập họ và tên" value="{{ Auth::check() ? Auth::user()->fullname : '' }}">
                                @error('fullname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="" class="form-label"><b>Số điện thoại*</b></label>
                                <input type="text" name="phone_number" required class="form-control"
                                    placeholder="Nhập số điện thoại">
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Địa chỉ*</b></label>
                            <input type="text" class="form-control" name="shipping_address" required
                                placeholder="Nhập địa chỉ">
                            @error('shipping_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <h5 class="text-uppercase mt-4">Thông tin bổ sung</h5>
                            <div>
                                <label for="" class="form-label"><b>Ghi chú đơn hàng (Tùy chọn)</b></label>
                                <textarea class="form-control" name="customer_notes" id="" rows="4" placeholder="Ghi chú về đơn hàng"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h5 class="text-uppercase">Đơn hàng của bạn</h5>
                        <table class="table">
                            <thead>
                                <th colspan="2">SẢN PHẨM</th>
                                <th>TẠM TÍNH</th>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ Storage::url($item['image']) }}" width="100" class="rounded"
                                                alt="">
                                        </td>
                                        <td>
                                            {{ $item['name'] }} - <span>{{ $item['size'] }}</span>
                                            <div>
                                                <b class="">x {{ $item['quantity'] }}</b>
                                            </div>
                                        </td>
                                        <td>
                                            {{ number_format($item['subtotal'], 0, ',', '.') }} <u>đ</u>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="2">Tổng</th>
                                    <th>
                                        {{ number_format($total_amount, 0, ',', '.') }} <u>đ</u>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <input type="hidden" name="total_amount" value="{{ $total_amount }}">
                        </div>
                        <div class="mt-4">
                            <input type="radio" name="payment_method" value="cod" checked class="form-check-input">
                            <label for="" class="form-label ms-3"><b>Thanh toán khi nhận hàng (COD)</b></label>
                        </div>
                        <div class="mt-3">
                            <input type="radio" name="payment_method" value="transfer" class="form-check-input">
                            <label for="" class="form-label ms-3"><b>Chuyển khoản ngân hàng</b></label>
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-danger w-100">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <h3 class="text-center">Chưa có sản phẩm nào</h3>
        @endif
    </div>
@endsection
