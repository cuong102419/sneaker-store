@extends('admin.layout.layout')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold">Sản phẩm</h3>
        </div>
        <div class="card">
            <div class="card-header">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div>
                    <form action="{{ route('products.index') }}" class="w-25" method="GET">
                        @csrf
                        <div class="d-flex">
                            <input type="search" name="search" class="form-control"
                                placeholder="Tìm kiếm theo tên hoặc mã.">
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
                                <th>Stt</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th style="width: 10%" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td class=" {{ $statusLabels[$item->status]['class'] }}">
                                        <strong>{{ $statusLabels[$item->status]['label'] }}</strong>
                                    </td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('products.show', $item->id) }}" title=""
                                                class="btn btn-link btn-primary btn-lg" data-original-title="">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Bạn có muốn xóa sản phẩm này.')"
                                                    class="btn btn-link btn-lg text-danger"><i
                                                        class="fa-solid fa-xmark fa-lg"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
