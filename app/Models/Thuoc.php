<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thuoc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'tenThuoc',
        'congDung',
        'ngayNhap',
        'hanSuDung',
        'soLuongNhap',
        'tinhTrang',
        'id_nhacungcap',
        'id_nhanvienkho'
    ];
    protected $primaryKey = 'id_thuoc';
    protected $table = 'tbl_thuoc';
}
