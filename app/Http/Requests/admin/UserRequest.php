<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $uniqueEmail = 'unique:users,email';
        // Rules update
        if (session('id')) {
            $id = session('id');
            $uniqueEmail .= ",{$id}";
            return [
                'name' => 'required',
                'email' => "required|email|{$uniqueEmail}",
                'group_id' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 0)
                        $fail('Vui lòng chọn nhóm');
                }],
            ];
        }
        // Rules thêm
        return [
            'name' => 'required',
            'email' => "required|email|{$uniqueEmail}",
            'password' => 'required',
            'group_id' => ['required', function ($attribute, $value, $fail) {
                if ($value == 0)
                    $fail('Vui lòng chọn nhóm');
            }],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'email' => 'Email không đúng định dạng',
            'unique' => 'Email đã được sử dụng',
            // 'group_id.required' => 'Vui lòng chọn nhóm'
        ];
    }

    public function attributes()
    {
        return   [
            'name' => 'Họ & Tên',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
        ];
    }
}
