@extends('admin.layout.layout')

@section('title')
    Dasbroad
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold">Quản trị hệ thống</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 shadow d-flex align-items-center">
                    <div class="bg-primary text-light p-4 me-2" style="position: relative; width: 100px; height: 100px;">
                        <i class="fa-solid fa-cart-shopping fa-4x"
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                    </div>
                    <div class="bg-white flex-fill p-3">
                        <h4>Tổng số đơn hàng: {{ $totalOrder }}</h4>
                        <a href="{{ route('order.index') }}">Chi tiết</a>
                    </div>
                </div>
                <div class="col-sm-4 shadow d-flex align-items-center">
                    <div class="bg-danger text-light p-4 me-2" style="position: relative; width: 100px; height: 100px;">
                        <i class="fa-regular fa-user fa-4x"
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                    </div>
                    <div class="bg-white flex-fill p-3">
                        <h4>Thành viên: {{ $totalUser }} </h4>
                        <a href="{{ route('user.index') }}">Chi tiết</a>
                    </div>
                </div>
                <div class="col-sm-4 shadow d-flex align-items-center">
                    <div class="bg-success text-light p-4 me-2" style="position: relative; width: 100px; height: 100px;">
                        <i class="fa-regular fa-comment fa-4x"
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                    </div>
                    <div class="bg-white flex-fill p-3">
                        <h4>Bình luận: {{$totalComment}} </h4>
                        <a href="{{ route('comment.index') }}">Chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="row mt-5 justify-content-around">
                <div class="col-5 bg-white shadow me-2x">
                    <h4 class="text-center mt-3">Top 10 sản phẩm bán chạy</h4>
                    <table class="table">
                        <tbody>
                            @foreach ($bestSelling as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('products.show', $item->id) }}">
                                            <img src="{{ Storage::url($item->image) }}" width="60" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <strong>{{ $item->sales_count }} lượt mua</strong>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->price, 0, ',', '.') }}đ</strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-5 bg-white shadow">
                    <h4 class="text-center mt-3">Top 10 sản phẩm xem nhiều nhất</h4>
                    <table class="table">
                        <tbody>
                            @foreach ($bestViewing as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('products.show', $item->id) }}">
                                            <img src="{{ Storage::url($item->image) }}" width="60" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <strong>{{ $item->view }} lượt xem</strong>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->price, 0, ',', '.') }}đ</strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
