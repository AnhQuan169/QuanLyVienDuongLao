<?php

namespace App\Http\Requests;

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
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirmpww' => 'required',
            'hoTen' => 'required',
            'gioiTinh' => 'required',
            'ngaySinh' => 'required',
            'anhDaiDien' => 'required',
            'CCCD' => 'required|numeric',
            'soDienThoai' => 'required|numeric',
            'diaChi' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên tài khoản',
            'name.unique' => 'Tên tài khoản đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'confirmpww.required' => 'Vui lòng nhập lại mật khẩu',
            'hoTen.required' => 'Vui lòng nhập họ tên',
            'gioiTinh.required' => 'Vui lòng chọn giới tính',
            'ngaySinh.required' => 'Vui lòng chọn ngày Sinh',
            'anhDaiDien.required' => 'Vui lòng chọn ảnh đại diện',
            'CCCD.required' => 'Vui lòng nhập số căn cước công dân',
            'soDienThoai.required' => 'Vui lòng nhập số điện thoại',
            'diaChi.required' => 'Vui lòng nhập địa chỉ',
        ];
    }
}
