@extends('layouts.admin')

@section('title', 'Danh sách nhóm')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách nhóm</h1>
    </div>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    {{-- @can('create', App\Model\Group::class) --}}
    @can('group.add')
        <a href="{{ route('admin.group.create') }}" class="btn btn-primary mb-3">Thêm mới</a>
    @endcan
    @if ($lists->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tên</th>
                    <th width="15%">Người đăng</th>
                    @can('group.permission')
                        <th width="15%">Phân quyền</th>
                    @endcan
                    @can('group.edit')
                        <th width="5%">Sửa</th>
                    @endcan
                    @can('group.delete')
                        <th width="5%">Xóa</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $key => $group)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $group->name }}</td>
                        <td>
                            {{-- @php
                                dd($group->groupBy->name)
                            @endphp --}}
                            {{ !empty($group->postBy->name) ? $group->postBy->name : false }}
                        </td>
                        @can('group.permission')
                            <td>
                                <a href="{{ route('admin.group.permission', $group) }}" class="btn btn-primary">Phân quyền</a>
                            </td>
                        @endcan
                        @can('group.edit')
                            <td>
                                <a href="{{ route('admin.group.update', $group) }}" class="btn btn-warning">Sửa</a>
                            </td>
                        @endcan
                        @can('group.delete')
                            <td>
                                <a onclick="return confirm('Bạn có chắc muốn xóa?')"
                                    href="{{ route('admin.group.delete', $group) }}" class="btn btn-danger">Xóa</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
