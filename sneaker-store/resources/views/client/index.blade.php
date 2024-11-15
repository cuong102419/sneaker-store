@extends('client.layout.layout')

@section('title')
    Sneaker Store
@endsection

@section('content')
    @if (session('success-auth'))
        <script>
            alert("{{ session('success-auth') }}");
        </script>
    @endif
    @include('client.layout.partials.slideshow')

    <div class="container mt-3">
        <h3 class="text-uppercase text-center">Sản phẩm mới</h3>
        <div class="row mt-3 mb-5">
            @foreach ($productsNew as $product)
                <div class="col-3 mb-3">
                    <a href="{{ route('product.show', $product->id) }}" class="p-0">
                        <div class="text-center border rounded-3 box-img-product">
                            <img src="{{ Storage::url($product->image) }}" width="200" alt="">
                        </div>
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('product.show', $product->id) }}"
                            class="text-decoration-none name-product">{{ $product->name }}</a>
                        <div>
                            <span
                                class="text-danger"><b>{{ number_format($product->price, 0, ',', '.') }}<u>đ</u></b></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <h3 class="text-uppercase mt-4 text-center">Sản phẩm nhiều lượt xem</h3>
        <div class="row mt-3 mb-5">
            @foreach ($productsView as $product)
                <div class="col-3 mb-3">
                    <a href="{{ route('product.show', $product->id) }}" class="p-0">
                        <div class="text-center border rounded-3 box-img-product">
                            <img src="{{ Storage::url($product->image) }}" width="200" alt="">
                        </div>
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('product.show', $product->id) }}"
                            class="text-decoration-none name-product">{{ $product->name }}</a>
                        <div>
                            <span
                                class="text-danger"><b>{{ number_format($product->price, 0, ',', '.') }}<u>đ</u></b></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
