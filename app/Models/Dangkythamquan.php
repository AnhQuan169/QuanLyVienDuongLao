<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dangkythamquan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nguoiDaiDienDK','soLuongDK','emailDK','soDienThoaiDK','ghiChuDK','ngayThamQuanDK','thoigianTQ','ngayDangKyDK','tinhTrangDK','ngayDuyetDK','id_quanly'
    ];
    protected $primaryKey = 'id_dangky';
    protected $table = 'tbl_dangkythamquan';
}
