<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Master\Periode;
use App\Models\Setting\Tahun;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Periode::orderby('id', 'desc')->paginate(10);

        return view('setting.periode.index', [
            "data" => $data,
            "no" => 0
        ]);
    }


    public function create()
    {
        //
        $mode = "add";
        $tahun = Tahun::where('aktif', 'Y')->orderby('id', 'desc')->get();
        $aksi = url('periode-store');

        // dd($data);
        return view('setting.periode.tambah', [
            "mode" => $mode,
            "aksi" => $aksi,
            "tahun" => $tahun,
            "nama_periode" => "",
            "tahun_id" => "",
            "index_bulan" => "",
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
            $data = Periode::create($request->all());
            session()->flash('success', 'Data sudah berhasil di proses..');
            return redirect('/periode');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect('/periode');
        }
    }


    public function edit($id)
    {
        $mode = "edit";
        $tahun = Tahun::where('aktif', 'Y')->orderby('id', 'desc')->get();
        $data = Periode::find($id);
        $aksi = url('periode-update');

        // dd($data);
        return view('setting.periode.tambah', [
            "mode" => $mode,
            "aksi" => $aksi,
            "tahun" => $tahun,
            "nama_periode" => $data->nama_periode,
            "tahun_id" => $data->tahun_id,
            "index_bulan" => $data->index_bulan,
            "aktif" => $data->aktif,
            "id" => $data->id,
        ]);
    }


    public function update(Request $request)
    {

        try {
            $data = Periode::find($request->id);
            $data->update([
                "nama_periode" => $request->nama_periode,
                "tahun_id" => $request->tahun_id,
                "index_bulan" => $request->index_bulan,
                "aktif" => $request->aktif
            ]);
            session()->flash('success', 'Data sudah berhasil di proses..');
            return redirect('/periode');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect('/periode');
        }
    }
}