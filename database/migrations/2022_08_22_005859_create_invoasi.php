<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inovasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->unsignedBigInteger('jenis_id');
            $table->string('nama');
            $table->string('nik_nim');
            $table->string('status_penulis');
            $table->string('prodi');
            $table->string('fakultas');
            $table->string('startup_tekno')->nullable();
            $table->string('perush_spinoff')->nullable();
            $table->string('income_inovasi')->nullable();
            $table->string('status_implementasi')->nullable();
            $table->text('dampak_sosial')->nullable();
            $table->string('produk_hasil')->nullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('mitra_id');
            $table->date('pendaftaran_inovasi')->nullable();
            $table->date('selesai_inovasi')->nullable();
            $table->date('pendaftaran_haki')->nullable();
            $table->date('selesai_haki')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inovasi');
    }
}
