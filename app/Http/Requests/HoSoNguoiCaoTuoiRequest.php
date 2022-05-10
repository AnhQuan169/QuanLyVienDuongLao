<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HoSoNguoiCaoTuoiRequest extends FormRequest
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
            'anhDon' => 'required|max:250',
            'anhToKhaiDeNghiTroGiup' => 'required|max:250',
            'anhSoYeuLyLich' => 'required|max:250',
            'hoTenNCC' => 'required',
            'gioiTinNCCh' => 'required',
            'ngaySinhNCC' => 'required|date',
            'anhDaiDienNCC' => 'required|max:250',
            'CCCD_NCC' => 'required|numeric',
            'soDienThoaiNCC' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'anhDon.required' => 'Vui lòng chọn ảnh của đối tượng hoặc người giám hộ (Theo mẫu)',
            'anhToKhaiDeNghiTroGiup.required' => 'Vui lòng chọn ảnh tờ khai đề nghị trợ giúp (Đã được công chứng, theo mẫu)',
            'anhSoYeuLyLich.required' => 'Vui lòng chọn ảnh sơ yếu lý lịch (Đã được công chứng, theo mẫu)',
            'hoTenNCC.required' => 'Vui lòng nhập họ tên người cao tuổi',
            'gioiTinhNCC.required' => 'Vui lòng chọn giới tính',
            'ngaySinhNCC.required' => 'Vui lòng chọn ngày sinh',
            'anhDaiDienNCC.required' => 'Vui lòng ảnh chân dung người cao tuổi',
            'CCCD_NCC.required' => 'Vui lòng nhập số căn cước công dân',
            'soDienThoaiNCC.required' => 'Vui lòng nhập số điện thoại',
        ];
    }
}
