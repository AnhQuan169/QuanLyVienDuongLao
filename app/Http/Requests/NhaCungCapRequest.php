<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhaCungCapRequest extends FormRequest
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
            'ten_ncc' => 'required',
            'diaChi_ncc' => 'required',
            'email_ncc' => 'required|email',
            'soDienThoai_ncc' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'ten_ncc.required' => 'Vui lòng nhập tên nhà cung cấp',
            'diaChi_ncc.required' => 'Vui lòng nhập địa chỉ',
            'email_ncc.required' => 'Vui lòng nhập email',
            'soDienThoai_ncc.required' => 'Vui lòng nhập số điện thoại',
        ];
    }
}
