<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.role.role-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumbs'] = [['link' => route('role.index'), 'name' => "Kelola Role"], ['name' => "Form"]];
        return view('pages.role.role-form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $input = $request->all();
            $query = \App\Roles::create($input);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }

        return redirect()->route('jenis-inovasi.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['breadcrumbs'] = [['link' => route('role.index'), 'name' => "Kelola Jenis Inovasi"], ['name' => "Form"]];
        $data['data'] = \App\Roles::find($id);

        return view('pages.role.role-form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            \App\Roles::find($id)->update($input);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }

        return redirect()->route('jenis-inovasi.index')->with('success','Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            \App\JenisInovasi::find($id)->delete();
            DB::commit();
            return redirect()->route('role.index')->with('success','Data berhasil dihapus');
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function getData(Request $request) {
        $input = $request->all();

        $query = new \App\Roles;

        $length = (int)@$input['length'];
        $start = (int)@$input['start'];
        $search = @$input['search'];
        $order = @$input['order'];

        $data = array();
        $count = $query->count();

        $data['recordsFiltered'] = $count;
        $data['recordsTotal'] = $count;

        if (!empty($search) AND !empty($search['value'])) {
            $query = $query->where(function ($q) use ($search) {
                $q->orWhere('name', 'like', '%' . $search['value'] . '%');
            });
        }

        $data['recordsFiltered'] = $query->count();
        $query = $query->skip($start)->take($length)->orderBy('id', 'DESC');
        $i = $start + 1;

        foreach ($query->get() as $row) {
            $row['no'] = $i++;
            
            $row['edit']  = route('role.edit',$row->id);
            $row['destroy'] = route('role.destroy',$row->id);

            $data['data'][] = $row;
        }

        if (empty($data['data'])) {
            $data['recordsTotal'] = $count;
            $data['recordsFiltered'] = 0;
            $data['data'] = [];
        }

        return response()->json($data);
    }
}
