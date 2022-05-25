<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiHangHoa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ten_loaiHangHoa',
        'mota_loaiHangHoa'
    ];
    protected $primaryKey = 'id_loaiHangHoa';
    protected $table = 'tbl_loaihanghoa';
}
