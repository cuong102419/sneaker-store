@extends('client.layout.layout')

@section('title')
    Đăng ký
@endsection

@section('content')
    <div class="container mt-3 mb-4">
        <h4 class="text-center text-uppercase">Đăng ký</h4>
        @if (session('message'))
            <h5 class="text-danger text-center mt-3">{{ session('message') }}</h5>
        @endif

        <div class="d-flex justify-content-center">
            <form class="w-50" action="{{ route('register') }}" method="post">
                @csrf
                <div>
                    <label for="" class="form-label">Họ tên</label>
                    <input type="text" name="fullname" required class="form-control" placeholder="Nhập họ tên">
                    @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" required class="form-control" placeholder="Nhập email">
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
                    <button type="submit" class="btn btn-dark">Đăng ký</button>
                    <div class="mt-2">
                        <small><a href="{{ route('formLogin') }}" class="text-decoration-none text-dark">Đăng
                                nhập.</a></small>
                    </div>
                </div>
                <div class="mt-3">Hoặc đăng ký với</div>
                <div class="mt-2">
                    <a href="{{ route('auth.google') }}" class="btn btn-primary"><i class="fa-brands fa-google fa-xl"></i></a>
                    <a href="" class="btn btn-light text-primary"><i class="fa-brands fa-facebook fa-2xl"></i></a>
                </div>
            </form>
        </div>
    </div>
@endsection
