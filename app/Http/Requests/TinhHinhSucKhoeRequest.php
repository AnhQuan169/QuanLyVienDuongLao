<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TinhHinhSucKhoeRequest extends FormRequest
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
            'huyetAp' => 'required|numeric',
            'nhipTim' => 'required|numeric',
            'canNang' => 'required|numeric',
            'trieuChung' => 'required',
            'ghiChu' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'huyetAp.required' => 'Vui lòng nhập số huyết áp',
            'nhipTim.required' => 'Vui lòng nhập thông tin nhịp tim',
            'canNang.required' => 'Vui lòng nhập thông tin cân nặng',
            'trieuChung.required' => 'Vui lòng nhập thông tin triệu chứng',
            'ghiChu.required' => 'Vui lòng nhập thông tin ghi chú',
        ];
    }
}
