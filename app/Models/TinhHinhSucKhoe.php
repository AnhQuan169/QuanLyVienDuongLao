<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinhHinhSucKhoe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_nguoicaotuoi',
        'huyetAp',
        'nhipTim',
        'canNang',
        'thoiGian',
        'ngayKham',
        'trieuChung',
        'ghiChu',
        'id_nhanvienyte'
    ];
    protected $primaryKey = 'id_thsk';
    protected $table = 'tbl_tinhhinhsuckhoe';
}
