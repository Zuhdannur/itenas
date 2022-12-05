<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index() {
        $data['breadcrumbs'] = [['name' => "Pengaturan"]];
        $data['user'] = \App\User::find(Auth()->user()->id);
        return view('pages.settings.index')->with($data);
    }

    public function update(Request $request,$id) {
        try {
            $update = \App\User::find($id)->update($request->all());
            return redirect()->back()->with('success','berhasil di perbaharui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
        }
       
    }

    public function profilePicture(Request $request) {
        try {
            $files = $request->file('file');
            $newFileName = Auth()->user()->username.'-'.$files->getClientOriginalName();
            Storage::disk('local')->put('public/'.$newFileName, file_get_contents($files));

            \App\User::find(Auth()->user()->id)->update([
                "avatar" => $newFileName
            ]);


            return response()->json([
                "message" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e
            ],500);
        }
    }

    public function changeAppIcon(Request $request) {
        try {
            $files = $request->file('file');
            $newFileName = 'bg.'.$files->extension();
            Storage::disk('local')->put('public/'.$newFileName, file_get_contents($files));

            \App\AppConfig::createOrUpdate($newFileName);

            return response()->json([
                "message" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e
            ],500);
        }
    }
}
