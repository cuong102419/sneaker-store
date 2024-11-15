@extends('client.layout.layout')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="container mt-3">
        <div>
            @if (session('successComment'))
                <script>
                    alert("{{ session('successComment') }}");
                </script>
            @endif
        </div>
        <div class="row">
            <div class="col-6">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active text-center">
                            <img id="carouselImage" src="{{ Storage::url($product->image) }}"
                                class="d-block w-100 border rounded-4" alt="...">
                        </div>
                        @foreach ($productAbImage as $index => $album)
                            <div class="carousel-item text-center">
                                <img src="{{ Storage::url($album->image) }}" class="d-block w-100 border rounded-4"
                                    alt="...">
                            </div>
                        @endforeach
                    </div>

                    <!-- Previous Button -->
                    <button class="carousel-control-prev position-absolute top-50 start-0 translate-middle-y" type="button"
                        data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-2" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <!-- Next Button -->
                    <button class="carousel-control-next position-absolute top-50 end-0 translate-middle-y" type="button"
                        data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-2" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    {{-- Thumbnails --}}
                    <div class="thumbnail-carousel d-flex overflow-auto mt-3">
                        <img src="{{ Storage::url($product->image) }}" class="thumbnail-img border rounded-2 me-2"
                            data-bs-target="#carouselExample" data-bs-slide-to="" width="100" alt="">

                        @foreach ($productAbImage as $album)
                            <img src="{{ Storage::url($album->image) }}" class="thumbnail-img border rounded-2 me-2"
                                data-bs-target="#carouselExample" data-bs-slide-to="" width="100" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="ms-5">
                    <h4 class="mt-2">{{ $product->name }}</h4>
                    <div class="mt-3">
                        <h4 class="text-danger">{{ number_format($product->price, 0, ',', '.') }}<u>đ</u></h4>
                    </div>
                    <div class="mt-5">
                        <b>Kích cỡ:</b>
                        <form action="{{ route('addToCart') }}" class="mt-3" method="POST">
                            @csrf
                            <div class="mb-3">
                                @foreach ($productVariant as $variant)
                                    <button type="button" class="size-option btn me-2"
                                        onclick="selectSize(this, '{{ $variant->size_id }}','{{ $variant->id }}')">{{ $variant->size->size }}</button>
                                @endforeach
                            </div>
                            <div>
                                <button onclick="clearSelection()" type="button" class="btn btn-sm btn-outline-warning"
                                    hidden id="deleteChange">Xóa</button>
                            </div>
                            <input type="hidden" name="variant_id" id="selectedSize">
                            <div class="mt-5 d-flex">
                                <button type="button" class="btn btn-sm btn-outline-dark rounded" onclick="increase()">
                                    <i class="fa-solid fa-plus fa-sm"></i>
                                </button>
                                <input type="number" class="form-control w-25 ms-2 me-2 text-center" name="quantity"
                                    min="1" value="1">
                                <button type="button" class="btn btn-sm btn-outline-dark rounded" onclick="decrease()">
                                    <i class="fa-solid fa-minus fa-sm"></i>
                                </button>
                            </div>
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mt-5">
                                <button id="addToCart" name="action" value="addToCart" type="submit"
                                    class="btn btn-lg btn-outline-dark" disabled>Thêm vào
                                    giỏ hàng</button>
                                <button id="buyNow" name="action" value="buyNow" type="submit"
                                    class="btn btn-lg btn-danger" disabled>Mua
                                    ngay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <hr>
            <div>
                <h4 class="text-center">Mô tả</h4>
                <div class="d-flex justify-content-center">
                    <div class="w-75">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 mb-5">
            <h5 class="text-center">Đánh giá sản phẩm</h5>
            <div class="mt-4 mb-4 d-flex justify-content-center">
                <div class="w-75">
                    @if ($comments->isNotEmpty())
                        <ul class="list-group">
                            @foreach ($comments as $comment)
                                <li class="list-group-item">
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <strong>{{ $comment->user->fullname }}:</strong>
                                            <div>
                                                <i>{{ date('d-m-Y', $comment->create_at) }}</i>
                                            </div>
                                        </div>
                                        <span>{{ $comment->content }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span><i>Chưa có đánh giá nào.</i></span>
                    @endif
                </div>
            </div>
            @if (Auth::user())
                <div class="d-flex justify-content-center">
                    <div class="w-75">
                        <form action="{{ route('comment.create') }}"x method="post">
                            @csrf
                            <div>
                                <textarea name="content" id="" class="form-control" required placeholder="Nhận xét của bạn."></textarea>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="mt-3">
                                <button class="btn btn-secondary">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <strong>Đăng nhập để nhận xét.</strong>
                </div>
            @endif
        </div>
    </div>
@endsection
