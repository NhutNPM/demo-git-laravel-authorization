@extends('layouts.admin')

@section('title', 'Cập nhật bài viết')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập nhật bài viết</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Vui lòng kiểm tra lại dữ liệu</div>
    @endif
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <form action="{{ route('admin.post.post-update') }}" method="post">
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control" name="title" value="{{ old('title') ?? $post->title }}" id=""
                placeholder="Tiêu đề..">
            @error('title')
                <small class="text-danger font-weight-bold ml-2">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <textarea name="content" class="form-control" id="" cols="30" rows="10" placeholder="Nội dung bài viết..">{{ old('content') ?? $post->content }}</textarea>
            @error('content')
                <small class="text-danger font-weight-bold ml-2">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
