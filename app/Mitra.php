<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitra';

    protected $guarded = [''];

    public $timestamps = false;


    public static function findOrCreate($params) {
        $obj = static::where([
            ['industri','=', $params[25]],
            ['jenis','=', $params[26]],
            ['national_international','=', $params[27]],
            ['sumber_pendanaan','=', $params[28]],
        ])->first();

        if(!$obj) {
            try {
                DB::beginTransaction();
                $create = static::create([
                    "industri" => $params[25],
                    "jenis" => $params[26],
                    "national_international" => $params[27],
                    "sumber_pendanaan" => $params[28]
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
