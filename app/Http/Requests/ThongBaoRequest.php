<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThongBaoRequest extends FormRequest
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
            'chuDe' => 'required',
            'noiDung' => 'required',
            'thoiGianDang' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'chuDe.required' => 'Vui lòng nhập chủ đề thông báo',
            'noiDung.required' => 'Vui lòng nhập nội dung thông báo',
            'thoiGianDang.required' => 'Vui lòng chọn thời gian đăng',
        ];
    }
}
