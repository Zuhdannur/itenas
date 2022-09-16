<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inovasi extends Model
{
    use HasFactory;

    protected $table = 'inovasi';

    protected $guarded = [''];

    public function jenis() {
        return $this->belongsTo(\App\JenisInovasi::class,'jenis_id','id');
    }

    public function mitra() {
        return $this->belongsTo(\App\Mitra::class,'mitra_id','id');
    }

}
