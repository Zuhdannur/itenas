<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInovasiForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inovasi', function (Blueprint $table) {
            $table->foreign('jenis_id')->references('id')->on('jenis_inovasi');
            $table->foreign('mitra_id')->references('id')->on('mitra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('jenis_id');
            $table->dropForeign('mitra_id');
        });
    }
}
