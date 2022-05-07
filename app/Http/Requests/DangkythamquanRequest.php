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
            'nguoiDaiDien' => 'required',
            'soLuong' => 'required|numeric|max:100',
            'email' => 'required|email',
            'soDienThoaiDK' => 'required|numeric|max:999999999',
            'ghiChu' => 'required',
            'ngayThamQuan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nguoiDaiDien.required' => 'Vui lòng nhập tên người đại diện',
            'soLuong.required' => 'Vui lòng nhập số lượng người tham quan',
            'email.required' => 'Vui lòng nhập email',
            'soDienThoaiDK.required' => 'Vui lòng nhập số điện thoại',
            'ghiChu.required' => 'Vui lòng nhập ghi chú',
            'ngayThamQuan.required' => 'Vui lòng chọn ngày tham quan',
        ];
    }
}
