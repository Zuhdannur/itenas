<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    use HasFactory;

    protected $table = "app_config";
    public $timestamps = false;

    protected $guarded = [''];


    public static function createOrUpdate($fileName) {
        $obj = static::first();
        if($obj) {
            $obj->update([
                "filename" => $fileName
            ]);
            return $obj;
        }

        $create = static::create([
            "filename" => $fileName
        ]);

        return $create;
    }
}
