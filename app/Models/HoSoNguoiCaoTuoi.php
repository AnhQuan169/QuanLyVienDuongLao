<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoSoNguoiCaoTuoi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_nguoidung',
        'phong',
        'giuong',
        'ngayVao',
        'anhDon',
        'anhToKhaiDeNghiTroGiup',
        'anhSoYeuLyLich',
        'anhGiayChungNhanHIV',
        'hoTenNCC',
        'gioiTinhNCC',
        'ngaySinhNCC',
        'anhDaiDienNCC',
        'CCCD_NCC',
        'soDienThoaiNCC',
        'diaChiNCC',
        'ngayDangKyNCC',
        'tinhTrangNCC',
        'ngayDuyetNCC',
        'id_quanly'
    ];
    protected $primaryKey = 'id_nguoicaotuoi';
    protected $table = 'tbl_hosonguoicaotuoi';
}
