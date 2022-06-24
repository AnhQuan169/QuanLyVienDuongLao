<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThuocRequest extends FormRequest
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
            'tenThuoc' => 'required',
            'congDung' => 'required',
            'ngayNhap' => 'required|date',
            'hanSuDung' => 'required',
            'soLuongNhap' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'tenThuoc.required' => 'Vui lòng nhập tên thuốc',
            'congDung.required' => 'Vui lòng nhập công dụng thuốc',
            'ngayNhap.required' => 'Vui lòng chọn ngày nhập',
            'hanSuDung.required' => 'Vui lòng hạn sử dụng',
            'soLuongNhap.required' => 'Vui lòng nhập số lượng nhập'
        ];
    }
}
