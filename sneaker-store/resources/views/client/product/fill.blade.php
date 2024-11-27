@extends('client.layout.layout')

@section('title')
    Thương hiệu
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <h3 class="text-uppercase text-center">Giày theo hãng</h3>
        <div class="row mt-3 mb-5">
            @foreach ($products as $product)
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
        {{ $products->links() }}
    </div>
@endsection