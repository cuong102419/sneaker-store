@extends('admin.layout.layout')

@section('title')
    Tạo mới sản phẩm
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tạo mới</h3>
        </div>
        <div>
            <div class="card">
                <div class="card-body d-flex justify-content-center">
                    <form action="{{ route('products.store') }}" method="post" class="w-75" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Nhập tên sản phẩm.">
                                    @error('name')
                                        <small id="emailHelp"
                                            class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Danh mục</label>
                                    <select name="category_id" id="" class="form-select">
                                        <option value="" selected disabled>Chọn danh mục</option>
                                        @foreach ($categories as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small id="emailHelp"
                                            class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Ảnh sản phẩm</label>
                                    <input type="file" required class="form-control" name="image">
                                    @error('image')
                                        <small id="emailHelp"
                                            class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Kích cỡ và Số lượng</label>
                                    <div id="size-quantity-container">
                                    </div>
                                    <select id="size-selector" class="form-select mt-2">
                                        <option value="" disabled selected>Chọn kích cỡ</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                                    @error('sizes')
                                        <small class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Giá</label>
                                    <input type="number" min="1" step="0.1" class="form-control" name="price"
                                        placeholder="Nhập giá sản phẩm.">
                                    @error('price')
                                        <small id="emailHelp"
                                            class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <label for="" class="form-label">Album ảnh sản phẩm</label>
                                    <input type="file" multiple name="ab_image[]" required id="" class="form-control">
                                    @error('ab_image')
                                        <small class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Mô tả</label>
                                <textarea class="form-control" name="description" rows="5" placeholder="Nhập mô tả sản phẩm."></textarea>
                                @error('description')
                                    <small id="emailHelp" class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary btn-sm">Tạo mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
