<header>
    <div style="height: 40px" class="d-flex align-items-center text-light bg-secondary top-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <p class="me-4 mb-0"><i class="fa-solid fa-location-dot"></i> Hanoi, Vietnam</p>
                <p class="mb-0"><i class="fa-solid fa-phone"></i> +84986 927 182</p>
            </div>
            <div class="d-flex align-items-center">
                <a href="#" class="btn text-light"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="btn text-light"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" class="ms-2 btn text-light"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="navbar shadow" style="height: 80px">
        <div class="d-flex justify-content-between align-items-center  container">
            <a href="{{ route('home') }}" class=" text-decoration-none text-dark">
                <h4 class="text-uppercase">Sneaker store</h4>
            </a>
            <ul class="nav text-uppercase">
                <li class="nav-item">
                    <a class="nav-link text-decoration-none link-menu" href="{{ route('home') }}">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button type="button" class="btn btn-link text-decoration-none text-dark"
                            data-bs-toggle="dropdown">
                            THƯƠNG HIỆU
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $item)
                                <a href="{{ route('brand.index', $item->id) }}" class="dropdown-item">{{ $item->name }}</a>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-decoration-none link-menu" href="#">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-decoration-none link-menu" href="#">Về chúng tôi</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div>
                    <form action="{{ route('brand.search') }}" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nhập để tìm kiếm.">
                            <button type="submit" class="btn btn-sm border"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <div class="ms-4 text-secondary d-flex">
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#cart"><i
                            class="fa-solid fa-cart-shopping fa-xl"></i></button>
                    @if (Auth::check())
                        <div class="dropdown">
                            <button type="button" class="btn dropdown" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-user fa-xl"></i>
                            </button>
                            <ul class="dropdown-menu">
                                @if (Auth::user()->roll == 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashbroad') }}"><i
                                                class="fa-solid fa-gauge me-2"></i> Trang
                                            quản trị</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('orderList') }}"><i
                                            class="fa-solid fa-clipboard me-2"></i>Đơn hàng</a></li>
                                <li><a class="dropdown-item" href="{{ route('information') }}"><i
                                            class="fa-solid fa-gear me-2"></i>Tài khoản</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                            class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="ms-1">
                            <a href="{{ route('formLogin') }}" type="button" class="btn"><i
                                    class="fa-solid fa-user fa-xl"></i></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    {{-- End Nav --}}

</header>
