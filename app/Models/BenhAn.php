<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenhAn extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_nguoiCaoTuoi',
        'tenBenhVien',
        'diaChi',
        'soDienThoai',
        'khoa',
        'bacSi',
        'ngayKham',
        'ngayVaoVien',
        'ngayRaVien',
        'tienSuBenh',
        'ketQuaXetNghiem',
        'chanDoan',
        'ngayHenKham',
        'ghiChu',
        'chiPhi'
    ];
    protected $primaryKey = 'id_benhAn';
    protected $table = 'tbl_benhan';
}
