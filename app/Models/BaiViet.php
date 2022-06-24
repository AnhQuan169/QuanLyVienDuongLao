<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'tenBaiViet',
        'hinhAnh',
        'noiDung',
        'tacGia',
        'ngayDang',
        'tinhTrang',
        'id_quanly'
    ];
    protected $primaryKey = 'id_baiViet';
    protected $table = 'tbl_baiviet';
}
