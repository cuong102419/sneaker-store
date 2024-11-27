@extends('admin.layout.layout')

@section('title')
    Quản lý người dùng
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold">Người dùng</h3>
        </div>

        <div class="card">
            <div class="card-header">
                @if (session('message'))
                    <div class="alert alert-success">
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="w-50">
                    <form action="{{ route('user.index') }}" method="GET" class="d-flex">
                        @csrf
                        <input type="search" name="search" class="form-control"
                            placeholder="Tìm kiếm người dùng theo email, họ tên, mã.">
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
                            <th>Họ tên</th>
                            <th>email</th>
                            <th>Trạng thái</th>
                            <th>Quyền</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th>{{ $user->id }}</th>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span
                                            class="{{ $status[$user->status]['class'] }}"><strong>{{ $status[$user->status]['value'] }}</strong></span>
                                    </td>
                                    <td>
                                        <span
                                            class="{{ $roll[$user->roll]['class'] }}"><strong>{{ $roll[$user->roll]['value'] }}</strong></span>
                                    </td>
                                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($user->status == 'active')
                                            <a href="{{ route('banAccount', $user->id) }}"
                                                onclick="return confirm('Bạn có chắc muốn khóa tài khoản này?')"
                                                class="btn btn-link btn-lg text-danger {{ $user->roll == 'admin' ? 'disabled' : '' }}"><i
                                                    class="fa-solid fa-ban"></i></a>
                                        @else
                                            <a href="{{ route('unbanAccount', $user->id) }}"
                                                onclick="return confirm('Bạn có chắc muốn mở khóa tài khoản này?')"
                                                class="btn btn-lg text-primary"><i class="fa-solid fa-check"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
