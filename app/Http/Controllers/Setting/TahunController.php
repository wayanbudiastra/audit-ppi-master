<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Tahun;
use Illuminate\Http\Request;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Tahun::all();

        return view('setting.tahun.index', [
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
        $aksi = url('tahun-store');

        // dd($data);
        return view('setting.tahun.tambah', [
            "mode" => $mode,
            "aksi" => $aksi,
            "nama_tahun" => "",
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
            $data = Tahun::create($request->all());
            session()->flash('success', 'Data sudah berhasil di proses..');
            return redirect('/tahun');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect('/tahun');
        }
    }

    public function edit($id)
    {
        //
        $mode = "edit";
        $data = Tahun::find($id);
        $aksi = url('tahun-update');

        return view('setting.tahun.tambah', [
            "mode" => $mode,
            "aksi" => $aksi,
            "nama_tahun" => $data->nama_tahun,
            "aktif" => $data->aktif,
            "id" => $data->id
        ]);
    }


    public function update(Request $request)
    {
        //
        try {
            $data = Tahun::find($request->id);
            $data->update([
                "nama_tahun" => $request->nama_tahun,
                "aktif" => $request->aktif
            ]);
            session()->flash('success', 'Data sudah berhasil di proses..');
            return redirect('/tahun');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect('/tahun');
        }
    }
}