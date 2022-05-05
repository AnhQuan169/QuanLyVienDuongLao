<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'chuDe','noiDung','thoiGianDang','id_quanlytrungtam'
    ];
    protected $primaryKey = 'id_thongbao';
    protected $table = 'tbl_thongbao';

    // public function userad(){
    //     return $this->belongsTo('App\Models\User','id');
    // }
}
