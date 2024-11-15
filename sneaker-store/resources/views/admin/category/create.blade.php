@extends('admin.layout.layout')

@section('title')
    Tạo mới danh mục
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tạo mới</h3>
        </div>
        <div>
            <div class="card">
                <div class="card-body d-flex justify-content-center">
                    <form action="{{ route('categories.store') }}" method="post" class="w-50" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" required
                                placeholder="Nhập tên danh mục">
                            @error('name')
                                <small id="emailHelp" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Ảnh danh mục</label>
                            <input type="file" class="form-control" name="image" required
                                placeholder="Nhập tên danh mục">
                            @error('image')
                                <small id="emailHelp" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
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
