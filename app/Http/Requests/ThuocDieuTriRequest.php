<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThuocDieuTriRequest extends FormRequest
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
            'id_thuoc' => 'required',
            'soLuong' => 'required|numeric',
            'ghiChu' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_thuoc.required' => 'Vui lòng chọn loại thuốc',
            'soLuong.required' => 'Vui lòng nhập số lượng',
            'ghiChu.required' => 'Vui lòng nhập ghi chú'
        ];
    }
}
