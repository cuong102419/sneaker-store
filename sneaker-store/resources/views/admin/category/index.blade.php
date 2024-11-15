@extends('admin.layout.layout')

@section('title')
    Danh mục
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Danh mục</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (session('success'))
                            <div class="alert alert-success mb-2">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div>
                            <form action="{{ route('categories.index') }}" class="w-25" method="GET">
                                <div class="d-flex">
                                    <input type="search" name="search" class="form-control" placeholder="Tìm kiếm danh mục.">
                                    <button type="submit" class="btn btn-info rounded-3 ms-1"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped">
                                <thead>
                                    <tr>
                                        <th>mã</th>
                                        <th>Tên danh mục</th>
                                        <th>Ảnh</th>
                                        <th style="width: 10%" class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $cate)
                                        <tr>
                                            <td>{{ $cate->id }}</td>
                                            <td>{{ $cate->name }}</td>
                                            <td>
                                                <img src="{{ Storage::url($cate->image) }}" width="100" alt="">
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('categories.edit', $cate->id) }}"
                                                        data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('categories.destroy', $cate->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-danger btn-lg"
                                                            onclick="return confirm('Bạn có chắc muốn xóa?')"
                                                            data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
