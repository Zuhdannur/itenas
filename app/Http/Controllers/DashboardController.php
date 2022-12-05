<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JsonException;

class DashboardController extends Controller
{
    public function index() {
        $breadcrumbs = [
            ['link'=>"home",'name'=>"Home"], ['name'=>"Index"]
        ];
        
        $query = new \App\Inovasi;

        $data['inovasi'] = count($query->get());
        $data['inovasi_selesai'] = count($query->where('selesai_inovasi','!=','null')->get());
        $data['inovasi_belum_selesai'] = count($query->where('selesai_inovasi','!=','null')->get());
        $data['daftar_haki'] = count($query->where('pendaftaran_haki','!=','null')->get());
        $data['peroleh_haki'] = count($query->where('selesai_haki','!=','null')->get());

        $data['statistics'] = json_encode(array($data['inovasi_selesai'],
        $data['inovasi_belum_selesai'],
        $data['daftar_haki'],
        $data['peroleh_haki']));


    
        return view('pages.dashboard.dashboard-index')->with($data);
    }

    public function getData(Request $request) {

    }
}
