<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangkythamquanRequest extends FormRequest
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
            'nguoiDaiDienDK' => 'required',
            'soLuongDK' => 'required|numeric|max:50',
            'emailDK' => 'required|email',
            'soDienThoaiDK' => 'required|numeric',
            'ghiChuDK' => 'required',
            'ngayThamQuanDK' => 'required|date',
            'thoigianTQ' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nguoiDaiDienDK.required' => 'Vui lòng nhập tên người đại diện',
            'soLuongDK.required' => 'Vui lòng nhập số lượng người tham quan',
            'emailDK.required' => 'Vui lòng nhập email',
            'soDienThoaiDK.required' => 'Vui lòng nhập số điện thoại',
            'ghiChuDK.required' => 'Vui lòng nhập ghi chú',
            'ngayThamQuanDK.required' => 'Vui lòng chọn ngày tham quan',
            'thoigianTQ.required' => 'Vui lòng chọn giờ tham quan',
        ];
    }
}
