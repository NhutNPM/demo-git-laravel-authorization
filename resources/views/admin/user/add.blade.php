@extends('layouts.admin')

@section('title', 'Thêm người dùng')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm người dùng</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Vui lòng kiểm tra lại dữ liệu</div>
    @endif
    <form action="" method="post">
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id=""
                placeholder="Họ & Tên..">
            @error('name')
                <small class="text-danger font-weight-bold ml-2">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="" placeholder="Email..">
            @error('email')
                <small class="text-danger font-weight-bold ml-2">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" id="" placeholder="Mật khẩu..">
            @error('password')
                <small class="text-danger font-weight-bold ml-2">{{ $message }}</small>
            @enderror
        </div>
        @if ($groups->count() > 0)
            <div class="mb-3">
                <select name="group_id" id="" class="form-control">
                    <option value="0">Chọn nhóm</option>
                    @foreach ($groups as $group)
                        <option value="{{$group->id}}" {{ old('group_id') == $group->id ? 'selected' : false }}>{{$group->name}}</option>
                    @endforeach
                </select>
                @error('group_id')
                    <small class="text-danger font-weight-bold ml-2">{{ $message }}</small>
                @enderror
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
