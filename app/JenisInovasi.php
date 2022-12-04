<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisInovasi extends Model
{
    use HasFactory;


    protected $table = 'jenis_inovasi';

    protected $guarded = [''];

    public $timestamps = false;

    public static function findOrCreate($params) {
        $obj = static::where('name','like','%'.$params[3].'%')->first();

        if(!$obj) {
            try {
                DB::beginTransaction();
                $create = static::create([
                    "name" => $params[3],
                ]);

                DB::commit();
                return $create;
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }

        return $obj;

    }
}
