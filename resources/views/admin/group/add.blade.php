@extends('layouts.admin')

@section('title', 'Thêm nhóm')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm nhóm</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Vui lòng kiểm tra lại dữ liệu</div>
    @endif
    <form action="" method="post">
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id=""
                placeholder="Tên nhóm..">
            @error('name')
                <small class="text-danger font-weight-bold ml-2">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
