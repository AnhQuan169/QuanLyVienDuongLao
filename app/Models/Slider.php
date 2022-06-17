<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ten_slide',
        'hinhAnh_slide'
    ];
    protected $primaryKey = 'id_slide';
    protected $table = 'tbl_slider';
}
