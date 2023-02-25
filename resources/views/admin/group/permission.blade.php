@extends('layouts.admin')

@section('title', 'Phân quyền nhóm: ' . $group->name)

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Phân quyền nhóm - {{ $group->name }}</h1>
    </div>
    {{-- @if ($errors->any())
        <div class="alert alert-danger text-center">Vui lòng kiểm tra lại dữ liệu</div>
    @endif --}}

    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif

    <form action="" method="post">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="20%">Module</th>
                    <th>Quyền</th>
                </tr>
            </thead>
            <tbody>
                @if ($modules->count() > 0)
                    @foreach ($modules as $module)
                        <tr>
                            <td>{{ $module->title }}</td>
                            <td>
                                <div class="row">
                                    @if (!empty($roleListArr))
                                        @foreach ($roleListArr as $roleName => $roleLabel)
                                            <div class="col-2">
                                                <label for="role_{{ $module->name }}_{{ $roleName }}">
                                                    <input type="checkbox" name="role[{{ $module->name }}][]"
                                                        value="{{ $roleName }}"
                                                        id="role_{{ $module->name }}_{{ $roleName }}"
                                                        {{ isRole($roleArr, $module->name, $roleName) ? 'checked' : false }}>
                                                    {{ $roleLabel }}
                                                </label>
                                            </div>
                                            {{-- <div class="col-2">
                                            <label for="">
                                                <input type="checkbox" name="" value="" id="">
                                                Thêm
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <label for="">
                                                <input type="checkbox" name="" value="" id="">
                                                Sửa
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <label for="">
                                                <input type="checkbox" name="" value="" id="">
                                                Xóa
                                            </label>
                                        </div> --}}
                                        @endforeach
                                    @endif

                                    @if ($module->name == 'group')
                                        <div class="col-3">
                                            <label for="role_{{ $module->name }}_permission">
                                                <input type="checkbox" name="role[{{ $module->name }}][]"
                                                    value="permission" id="role_{{ $module->name }}_permission"
                                                    {{ isRole($roleArr, $module->name, 'permission') ? 'checked' : false }}>
                                                Phân quyền
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Phần quyền</button>
    </form>

@endsection
