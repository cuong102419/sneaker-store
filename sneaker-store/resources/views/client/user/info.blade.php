@extends('client.layout.layout')

@section('title')
    Thông tin tài khoản
@endsection

@section('content')
    <div class="container mt-3 mb-4">
        <h4 class="text-center text-uppercase">Thông tin tài khoản</h4>
        @if (session('message'))
            <h5 class="text-danger text-center mt-3">{{ session('message') }}</h5>
        @endif

        <div class="d-flex justify-content-center">
            <form class="w-50" action="{{ route('changePassword') }}" method="post">
                @csrf
                @method('PUT')
                <div>
                    <label for="" class="form-label">Họ tên</label>
                    <input type="text" name="fullname" required class="form-control" value="{{ Auth::user()->fullname }}" placeholder="Nhập họ tên">
                    @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" required class="form-control" disabled value="{{ Auth::user()->email }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" required class="form-control" placeholder="Nhập mật khẩu">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" name="confirm_password" required class="form-control" placeholder="Nhập lại mật khẩu">
                    @error('confirm_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-dark">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
