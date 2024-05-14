<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Profesi;
use Illuminate\Http\Request;

class ProfesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Profesi::all();

        return view('setting.profesi.index', [
            "data" => $data,
            "no" => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mode = "add";
        $aksi = url('profesi-store');

        // dd($data);
        return view('setting.profesi.tambah', [
            "mode" => $mode,
            "aksi" => $aksi,
            "nama_profesi" => "",
            "aktif" => "",
            "id" => "",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $data = Profesi::create($request->all());
            session()->flash('success', 'Data sudah berhasil di proses..');
            return redirect('/profesi');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect('/profesi');
        }
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
        //
        $mode = "edit";
        $data = Profesi::find($id);
        $aksi = url('profesi-update');

        return view('setting.profesi.tambah', [
            "mode" => $mode,
            "aksi" => $aksi,
            "nama_profesi" => $data->nama_profesi,
            "aktif" => $data->aktif,
            "id" => $data->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try {
            $data = Profesi::find($request->id);
            $data->update([
                "nama_profesi" => $request->nama_profesi,
                "aktif" => $request->aktif
            ]);
            session()->flash('success', 'Data sudah berhasil di proses..');
            return redirect('/profesi');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect('/profesi');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
