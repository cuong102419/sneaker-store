<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashbroad') }}" class="logo">
                <h4 class="text-uppercase text-light">sneaker store</h4>
            </a>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.dashbroad') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="admin#base">
                        <i class="fa-solid fa-list"></i>
                        <p>Danh mục</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('categories.index') }}">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('categories.create') }}">
                                    <span class="sub-item">Tạo mới</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="admin#sidebarLayouts">
                        <i class="fa-solid fa-box"></i>
                        <p>Sản phẩm</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('products.index') }}">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('products.create') }}">
                                    <span class="sub-item">Tạo mới</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('size.index') }}">
                                    <span class="sub-item">Thuộc tính</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('order.index') }}">
                        <i class="fa-regular fa-clipboard"></i>
                        <p>Đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}">
                        <i class="fa-solid fa-user"></i>
                        <p>Người dùng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('comment.index') }}">
                        <i class="fa-solid fa-comment"></i>
                        <p>Bình luận</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
