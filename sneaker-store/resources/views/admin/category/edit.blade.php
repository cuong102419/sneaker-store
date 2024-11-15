@extends('admin.layout.layout')

@section('title')
    Cập nhật danh mục
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Cập nhật</h3>
        </div>
        <div>
            <div class="card">
                <div class="card-header">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card-body d-flex justify-content-center">
                    <form action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data" method="post" class="w-75">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" value="{{ $category->name }}"
                                placeholder="Nhập tên danh mục">
                            @error('name')
                                <small id="emailHelp" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Ảnh danh mục</label>
                            <input type="file" class="form-control" name="image" required
                                placeholder="Nhập tên danh mục">
                                <img src="{{ Storage::url($category->image) }}" width="100" class="mt-3 rounded" alt="">
                            @error('image')
                                <small id="emailHelp" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-secondary">Danh sách</a>
                            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
