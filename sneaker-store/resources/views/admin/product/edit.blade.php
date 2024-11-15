@extends('admin.layout.layout')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold">Chi tiết sản phẩm</h3>
        </div>
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="card-body d-flex justify-content-center">
                    <form action="{{ route('products.update', $product->id) }}" method="post" class="w-75" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Nhập tên sản phẩm." value="{{ $product->name }}">
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
                                            <option value="{{ $cate->id }}"
                                                @if ($cate->id == $product->category_id) selected @endif>{{ $cate->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small id="emailHelp"
                                            class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="image">
                                    <img src="{{ Storage::url($product->image) }}" width="100" class="mt-3 rounded"
                                        alt="">
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
                                        @foreach ($productVariants as $variant)
                                            <div class="d-flex mb-2"> <input type="hidden" name="sizes[]"
                                                    value="{{ $variant->size->size }}"> <span
                                                    class="me-2">{{ $variant->size->size }}</span> <input type="number"
                                                    name="quantities[]" class="form-control me-2" min="1"
                                                    value="{{ $variant->quantity }}" placeholder="Số lượng" required>
                                            </div>
                                        @endforeach
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
                                    @error('sizes')
                                        <small class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Giá</label>
                                    <input type="number" min="1" step="0.1" class="form-control" name="price"
                                        placeholder="Nhập giá sản phẩm." value="{{ $product->price }}">
                                    @error('price')
                                        <small id="emailHelp"
                                            class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <label for="" class="form-label">Album ảnh sản phẩm</label>
                                    <input type="file" multiple name="ab_image[]" id="" class="form-control">
                                    <div class="mt-3">
                                        @foreach ($albumImage as $item)
                                            <img src="{{ Storage::url($item->image) }}" width="70" alt="">
                                        @endforeach
                                    </div>
                                    @error('ab_image')
                                        <small class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Mô tả</label>
                                <textarea class="form-control" name="description" rows="6" placeholder="Nhập mô tả sản phẩm.">{{ $product->description }}</textarea>
                                @error('description')
                                    <small id="emailHelp" class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
