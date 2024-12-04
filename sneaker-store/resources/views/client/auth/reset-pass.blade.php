@extends('client.layout.layout')

@section('title')
    Khôi phục mật khẩu
@endsection

@section('content')
    <div class="container mt-3">
        <h4 class="text-center text-uppercase">Khôi phục mật khẩu</h4>
        @if (session('message'))
            <h5 class="text-danger text-center mt-3">{{ session('message') }}</h5>
        @endif
        <div class="d-flex justify-content-center mb-4">
            <form class="w-50" action="{{ route('change-password', $token) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mt-3">
                    <label for="" class="form-label">Nhập mật khẩu mới</label>
                    <input type="password" required name="password" class="form-control" placeholder="Nhập mật khẩu mới.">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Nhập lại mật khẩu mới</label>
                    <input type="password" required name="confirm-password" class="form-control" placeholder="Nhập lại mật khẩu mới.">
                    @error('confirm-password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-dark">Gửi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
