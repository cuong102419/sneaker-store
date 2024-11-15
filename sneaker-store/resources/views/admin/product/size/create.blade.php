@extends('admin.layout.layout')

@section('title')
    Tạo mới kích cỡ
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tạo mới</h3>
        </div>
        <div>
            <div class="card">
                <div class="card-body d-flex justify-content-center">
                    <form action="{{ route('size.store') }}" method="post" class="w-50">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Kích cỡ</label>
                            <input type="number" min="35" step="1" max="50" class="form-control" name="size" placeholder="Nhập kích cỡ.">
                            @error('size')
                                <small id="emailHelp" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm">Tạo mới</button>
                            <a href="{{ route('size.index') }}" class="btn btn-sm btn-secondary">Danh sách</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
