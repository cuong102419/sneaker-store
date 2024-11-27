@extends('admin.layout.layout')

@section('title')
    Quản lý bình luận
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold">Bình luận</h3>
        </div>
        <div class="card">
            <div class="card-header">
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                <div class="w-25">
                    <form action="{{ route('comment.index') }}" method="GET" class="d-flex">
                        @csrf
                        <input type="search" name="search" class="form-control" placeholder="Tìm kiếm theo mã, email.">
                        <button type="submit" class="btn btn-info rounded-3 ms-1">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Mã</th>
                            <th>Email</th>
                            <th>Sản phẩm</th>
                            <th>Nội dung</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </thead>
                        <tbody>
                            @foreach ($comments as $com)
                                <tr>
                                    <th>{{ $com->id }}</th>
                                    <td>
                                        {{ $com->user->email }}
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', $com->id) }}">{{ $com->product->name }}</a>
                                    </td>
                                    <td>
                                        {{ $com->content }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', $com->create_at) }}
                                    </td>
                                    <td>
                                        <form action="{{ route('comment.destroy', $com->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Bạn có muốn xóa bình luận này?')"
                                                class="btn btn-lg text-danger"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
