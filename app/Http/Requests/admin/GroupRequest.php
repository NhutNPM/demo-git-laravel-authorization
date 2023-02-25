<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueName = 'unique:groups,name';
        if (session('id')) {
            $id = session('id');
            $uniqueName .= ",{$id}";
            return [
                'name' => "required|{$uniqueName}",
            ];
        }
        return [
            'name' => 'required|unique:groups,name',
        ];
    }


    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'unique' => 'Nhóm quyền đã được sử dụng',
        ];
    }

    public function attributes()
    {
        return   [
            'name' => 'Tên nhóm quyền',
        ];
    }
}
