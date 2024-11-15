<div class="offcanvas offcanvas-end" id="cart">
    <div class="offcanvas-header">
        <h3>Giỏ hàng</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        @if (session('cart'))
            <div class="cart-container">
                <div class="cart-items">
                    <ul class="list-group list-group-flush">
                        @foreach ($cart as $item)
                            <li class="list-group-item">
                                <div class="d-flex">
                                    <a href="{{ route('product.show', $item['product_id']) }}">
                                        <img src="{{ Storage::url($item['image']) }}" width="100" alt="">
                                    </a>
                                    <div class="ms-3">
                                        <div class="d-flex">
                                            <a href="{{ route('product.show', $item['product_id']) }}" class="text-decoration-none text-dark">
                                                {{ $item['name'] }}
                                            </a>
                                            <div class="">
                                                <form action="{{ route('removeFromCart', $item['variant_id']) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn"><i
                                                            class="fa-solid fa-xmark"></i></button>

                                                </form>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <div>
                                                <small>Size: {{ $item['size'] }}</small>
                                            </div>
                                            <div>
                                                <span class="text-danger">{{ number_format($item['subtotal'], 0, ',', '.') }}<u>đ</u></span>
                                            </div>
                                        </div>
                                        <form action="{{ route('updateCart', $item['variant_id']) }}" method="post" id="form-quantity-{{ $item['variant_id'] }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mt-3">
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-sm btn-outline-dark rounded"
                                                        onclick="increaseCart({{ $item['variant_id'] }})">
                                                        <i class="fa-solid fa-plus fa-2xs"></i>
                                                    </button>
                                                    <input type="number"
                                                        class="form-control w-25 ms-2 me-2 text-center" name="quantity"
                                                        id="quantity-cart-{{ $item['variant_id'] }}" min="1"
                                                        value="{{ $item['quantity'] }}" onchange="updateCart({{ $item['variant_id'] }})">
                                                    <button type="button" class="btn btn-sm btn-outline-dark rounded"
                                                        onclick="decreaseCart({{ $item['variant_id'] }})">
                                                        <i class="fa-solid fa-minus fa-2xs"></i>
                                                    </button>
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-5">
                        <div class="text-center">
                            <a href="{{ route('pay') }}" class="btn btn-danger">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div>
                <div class="mb-3">
                    <span><i>Chưa có sản phẩm trong giỏ hàng.</i></span>
                </div>
                <div class="text-center">
                    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Tiếp tục mua sắm</a>
                </div>
            </div>
        @endif
    </div>
</div>
