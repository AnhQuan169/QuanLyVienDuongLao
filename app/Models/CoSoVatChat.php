<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoSoVatChat extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ten',
        'soLuong',
        'soLuongTon',
        'soLuongHuHong',
        'soLuongDangSuDung',
        'tinhTrang',
        'id_nhacungcap',
        'id_nhanvienkho'
    ];
    protected $primaryKey = 'id_csvc';
    protected $table = 'tbl_cosovatchat';
}
