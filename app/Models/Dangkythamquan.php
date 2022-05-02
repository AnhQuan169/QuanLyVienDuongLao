<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dangkythamquan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nguoiDaiDien','soLuong','email','soDienThoai','ghiChu','ngayThamQuan','ngayDangKy','tinhTrang','ngayDuyet','id_quanlytrungtam'
    ];
    protected $primaryKey = 'id_dangky';
    protected $table = 'tbl_dangkythamquan';
}
