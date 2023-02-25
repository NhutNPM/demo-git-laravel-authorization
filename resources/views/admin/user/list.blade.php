@extends('layouts.admin')

@section('title', 'Danh sách người dùng')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách người dùng</h1>
    </div>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    {{-- @can('create', App\Model\User::class) --}}
    @can('user.add')
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">Thêm mới</a>
    @endcan
    @if ($lists->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Nhóm</th>
                    <th>Thời gian</th>
                    @can('user.edit')
                        <th width="5%">Sửa</th>
                    @endcan
                    @can('user.delete')
                        <th width="5%">Xóa</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->group->name }}</td>
                        <td>{{ $user->created_at }}</td>
                        @can('user.edit')
                            <td>
                                <a href="{{ route('admin.user.update', $user) }}" class="btn btn-warning">Sửa</a>
                            </td>
                        @endcan
                        @can('user.delete')
                            <td>
                                @if (Auth::id() !== $user->id)
                                    <a onclick="return confirm('Bạn có chắc muốn xóa?')"
                                        href="{{ route('admin.user.delete', $user) }}" class="btn btn-danger">Xóa</a>
                                @endif
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
