@extends('admin.layout.layout')

@section('title')
    Kích cỡ
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold">Kích cỡ</h3>
        </div>
        <div class="card">
            <div class="card-header">
                @if (session('success'))
                    <div class="alert alert-success mb-2">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('size.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Tạo mới</a>
                </div>
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Kích cỡ</th>
                                <th style="width: 10%" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizes as $size)
                            <tr>
                                <td>{{ $size->id }}</td>
                                <td>{{ $size->size }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <form action="{{ route('size.destroy', $size->id) }}" method="post">
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
                </div>
            </div>
        </div>
    </div>
@endsection
