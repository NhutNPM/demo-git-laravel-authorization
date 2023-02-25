@extends('layouts.admin')

@section('title', 'Danh sách bài viết')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách bài viết</h1>
    </div>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif

    {{-- @can('create', App\Model\Post::class) --}}
    @can('post.add')
        <a href="{{ route('admin.post.create') }}" class="btn btn-primary mb-3">Thêm mới</a>
    @endcan
    @if ($lists->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tiêu đề</th>
                    <th width="15%">Người đăng</th>
                    <th width="15%">Thời gian</th>
                    @can('post.edit')
                        <th width="5%">Sửa</th>
                    @endcan
                    @can('post.delete')
                        <th width="5%">Xóa</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $key => $post)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ Str::of($post->title)->limit(60) }}</td>
                        <td>
                            {{ !empty($post->postBy->name) ? $post->postBy->name : false }}
                        </td>
                        <td>
                            {{ $post->created_at }}
                        </td>
                        @can('post.edit')
                            <td>
                                <a href="{{ route('admin.post.update', $post) }}" class="btn btn-warning">Sửa</a>
                            </td>
                        @endcan
                        @can('post.delete')
                            <td>
                                <a onclick="return confirm('Bạn có chắc muốn xóa?')"
                                    href="{{ route('admin.post.delete', $post) }}" class="btn btn-danger">Xóa</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
