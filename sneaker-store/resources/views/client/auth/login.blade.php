@extends('client.layout.layout')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <div class="container mt-3">
        <h4 class="text-center text-uppercase">Đăng nhập</h4>
        @if (session('message'))
            <h5 class="text-danger text-center mt-3">{{ session('message') }}</h5>
        @endif
        <div class="d-flex justify-content-center mb-4">
            <form class="w-50" action="{{ route('login') }}" method="post">
                @csrf
                <div>
                    <label for="" class="form-label">Email</label>
                    <input type="email" required name="email" class="form-control" placeholder="Nhập email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Mật khẩu</label>
                    <input type="password" required name="password" class="form-control" placeholder="Nhập mật khẩu">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-dark">Đăng nhập</button>
                    <div class="mt-2">
                        <small><a href="{{ route('formRegister') }}" class="text-decoration-none text-dark">Đăng ký tài
                                khoản.</a></small>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
