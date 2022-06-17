<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuocDieuTri extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_benhAn',
        'id_thuoc',
        'soLuong',
        'donVi',
        'ghiChu'
    ];
    protected $primaryKey = 'id_thuocDieuTri';
    protected $table = 'tbl_thuocdieutri';

}
