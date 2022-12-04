<?php
namespace App\Imports;

use App\Inovasi;
use App\Mitra;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportInovasi implements ToCollection {
    
    public function collection(Collection $rows)
    {

        
        foreach ($rows as $index => $row) 
        {
            $pendaftaran_inovasi = null;
            $penutupan_inovasi = null;
            $pendaftaran_haki = null;
            $selesai_haki = null;
            if($index > 4) {
                try {
                    DB::beginTransaction();


                    $no = $row[1];
                    $inovasi = $row[2];
                    $jenisInovasi = \App\JenisInovasi::findOrCreate($row)->id;
                    $nama = $row[4];
                    $idPengenal = $row[5];
                    $statusPenulis = $row[6];
                    $prodi = $row[8];
                    $fakultas = $row[9];
    
                    if($row[10] != null && $row[10] != '-') $pendaftaran_inovasi = Date::excelToDateTimeObject($row[10])->format('Y-m-d');
                    if($row[12] != null && $row[12] != '-') $penutupan_inovasi = Date::excelToDateTimeObject($row[12])->format('Y-m-d');
                    if($row[14] != null && $row[14] != '-') $pendaftaran_haki = Date::excelToDateTimeObject($row[14])->format('Y-m-d');
                    if($row[16] != null && $row[16] != '-') $selesai_haki = Date::excelToDateTimeObject($row[16])->format('Y-m-d');
                    
                    $startup = $row[18];
                    $spinoff = $row[19];
                    $income = $row[20];
                    $status_implementasi = $row[21];
                    $dampak_sosial = $row[22];
                    $produk_hasil = $row[23];
                    $deskripsi = $row[24];

                    //Mitra
                    $id_mitra = Mitra::findOrCreate($row)->id;


                    $create = Inovasi::create([
                        "judul" => $row[2],
                        "jenis_id" => $jenisInovasi,
                        "nama" => $nama,
                        "nik_nim" => $idPengenal,
                        "status_penulis" => $statusPenulis,
                        "prodi" => $prodi,
                        "fakultas" => $fakultas,
                        "startup_tekno" => $startup,
                        "perush_spinoff" => $spinoff,
                        "income_inovasi" => $income,
                        "status_implementasi" => $status_implementasi,
                        "dampak_sosial" => $dampak_sosial,
                        "produk_hasil" => $produk_hasil,
                        "deskripsi" => $deskripsi,
                        "mitra_id" => $id_mitra,
                        "pendaftaran_inovasi" => $pendaftaran_inovasi,
                        "selesai_inovasi" => $penutupan_inovasi,
                        "pendaftaran_haki" => $pendaftaran_haki,
                        "selesai_haki" => $selesai_haki,
                    ]);


                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    dd($e);
                }
            }
        }
    }
}
