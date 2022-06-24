<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BenhAnRequest extends FormRequest
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
            'tenBenhVien' => 'required',
            'diaChi' => 'required',
            'soDienThoai' => 'required|max:11',
            'khoa' => 'required',
            'bacSi' => 'required',
            'ngayKham' => 'required|date',
            'ngayVaoVien' => 'required|date',
            'ngayRaVien' => 'required|date',
            'tienSuBenh' => 'required',
            'ketQuaXetNghiem' => 'required',
            'chanDoan' => 'required',
            'ngayHenKham' => 'required|date',
            'ghiChu' => 'required',
            'chiPhi' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'tenBenhVien.required' => 'Vui lòng nhập tên bệnh viện',
            'diaChi.required' => 'Vui lòng nhập địa chỉ bệnh viện',
            'soDienThoai.required' => 'Vui lòng nhập số điện thoại bệnh viện',
            'khoa.required' => 'Vui lòng nhập khoa khám bệnh',
            'bacSi.required' => 'Vui lòng tên bác sĩ',
            'ngayKham.required' => 'Vui lòng chọn ngày khám',
            'ngayVaoVien.required' => 'Vui lòng chọn ngày vào viện',
            'ngayRaVien.required' => 'Vui lòng chọn ngày ra viện',
            'tienSuBenh.required' => 'Vui lòng nhập tiền sử bệnh',
            'ketQuaXetNghiem.required' => 'Vui lòng nhập kết quả xét nghiệm',
            'chanDoan.required' => 'Vui lòng nhập chẩn đoán',
            'ngayHenKham.required' => 'Vui lòng chọn ngày hẹn khám',
            'ghiChu.required' => 'Vui lòng nhập ghi chú',
            'chiPhi.required' => 'Vui lòng nhập chi phí'

        ];
    }
}
