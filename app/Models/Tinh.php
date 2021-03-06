<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tinh extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'city_name','city_type'
    ];
    protected $primaryKey = 'city_id';
    protected $table = 'tbl_tinhthanhpho';
}
