<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisInovasi extends Model
{
    use HasFactory;


    protected $table = 'jenis_inovasi';

    protected $guarded = [''];

    public $timestamps = false;
}
