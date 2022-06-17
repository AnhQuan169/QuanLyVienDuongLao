<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LienKet extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'hinhAnh_lienket',
        'link_lienket'
    ];
    protected $primaryKey = 'id_lienket';
    protected $table = 'tbl_lienket';
}
