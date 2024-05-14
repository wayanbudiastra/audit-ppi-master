<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Ruangan::all();

        return view('setting.ruangan.index', [
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
        //
        $mode = "add";
        $aksi = url('ruangan-store');

        // dd($data);
        return view('setting.ruangan.tambah', [
            "mode" => $mode,
            "aksi" => $aksi,
            "nama_ruangan" => "",
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
            $data = Ruangan::create($request->all());
            session()->flash('success', 'Data sudah berhasil di proses..');
            return redirect('/ruangan');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect('/ruangan');
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
        $data = Ruangan::find($id);
        $aksi = url('ruangan-update');

        return view('setting.ruangan.tambah', [
            "mode" => $mode,
            "aksi" => $aksi,
            "nama_ruangan" => $data->nama_ruangan,
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
            $data = Ruangan::find($request->id);
            $data->update([
                "nama_ruangan" => $request->nama_ruangan,
                "aktif" => $request->aktif
            ]);
            session()->flash('success', 'Data sudah berhasil di proses..');
            return redirect('/ruangan');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect('/ruangan');
        }
    }
}