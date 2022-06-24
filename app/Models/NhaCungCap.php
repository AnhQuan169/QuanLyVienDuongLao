<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhaCungCap extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ten_ncc',
        'diaChi_ncc',
        'email_ncc',
        'soDienThoai_ncc',
        'tinhTrang_ncc',
        'id_loaiHangHoa'
    ];
    protected $primaryKey = 'id_nhacungcap';
    protected $table = 'tbl_nhacungcap';
}
