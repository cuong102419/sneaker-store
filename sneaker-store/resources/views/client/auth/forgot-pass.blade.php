@extends('client.layout.layout')

@section('title')
    Quên mật khẩu
@endsection

@section('content')
    <div class="container mt-3">
        <h4 class="text-center text-uppercase">Quên mật khẩu</h4>
        @if (session('message'))
            <h5 class="text-danger text-center mt-3">{{ session('message') }}</h5>
        @endif
        <div class="d-flex justify-content-center mb-4">
            <form class="w-50" action="{{ route('recover-password') }}" method="post">
                @csrf
                <div>
                    <label for="" class="form-label">Email</label>
                    <input type="email" required name="email" class="form-control" placeholder="Nhập email">
                    @error('email')
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
