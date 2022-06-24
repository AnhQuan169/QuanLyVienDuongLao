<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoSoVatChatRequest extends FormRequest
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
            'ten' => 'required',
            'soLuong' => 'required|numeric|max:200',
            'soLuongTon' => 'required|numeric',
            'soLuongHuHong' => 'required|numeric',
            'soLuongDangSuDung' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Vui lòng nhập tên nhà cung cấp',
            'soLuong.required' => 'Nhập số lượng',
            'soLuongTon.required' => 'Nhập số lượng tồn',
            'soLuongHuHong.required' => 'Nhập số lượng hư hỏng',
            'soLuongDangSuDung.required' => 'Nhập số lượng đang sử dụng',
        ];
    }
}
