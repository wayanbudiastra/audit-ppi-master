<?php

namespace App\Http\Controllers\Observasi;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeriodeResource;
use App\Http\Resources\RuanganResource;
use App\Models\Master\Apd;
use App\Models\Master\Apd_detail;
use App\Models\Master\Periode;
use App\Models\Setting\Ruangan;
use Illuminate\Http\Request;

class ApdController extends Controller
{
    //

    public function mulai()
    {
        $period = PeriodeResource::collection(Periode::where('aktif', 'Y')->get());
        $ruangan = RuanganResource::collection(Ruangan::where('aktif', 'Y')->get());

        // return view('observasi.hand.index', [
        //     "period" => $period
        // ]);

        return view('observasi.apd.index', [
            "period" => $period,
            "ruangan" => $ruangan,
        ]);
    }

    public function simpan_satu(Request $request)
    {
        $request->validate([
            "periode" => 'required',
            "nama_auditor" => 'required',
            "auditor" => 'required',
            "ruangan_id" => 'required',
        ]);
        try {
            $data = Apd::create([
                "periode_id" => $request->periode,
                "nama_auditor" => $request->nama_auditor,
                "ruangan_id" => $request->ruangan_id,
                "auditor" => $request->auditor
            ]);

            $period = PeriodeResource::collection(Periode::where('aktif', 'Y')->get());
            $ruangan = RuanganResource::collection(Ruangan::where('aktif', 'Y')->get());
            session()->flash('success', 'Observasi sudah berhasil di proses..');
            // return redirect()->back();
            return view('observasi.apd.lanjut', [
                "data" => $data,
                "period" => $period,
                "ruangan" => $ruangan
            ]);
        } catch (\Exception $d) {
            session()->flash('error', 'Terjadi Kesalahan..' . $d);
            return redirect()->back();
        }
    }

    public function lanjut_input($id)
    {
        try {
            $data = Apd::find($id);
            $period = PeriodeResource::collection(Periode::where('aktif', 'Y')->get());
            $ruangan = RuanganResource::collection(Ruangan::where('aktif', 'Y')->get());

            return view('observasi.apd.lanjut', [
                "data" => $data,
                "period" => $period,
                "ruangan" => $ruangan
            ]);
        } catch (\Exception $d) {
            session()->flash('error', 'Terjadi Kesalahan..' . $d);
            return redirect()->back();
        }
    }

    public function lanjut(Request $request)
    {
        $request->validate([
            "nama_petugas" => 'required',
            "keterangan" => 'required',
        ]);

        try {
            $data = Apd::find($request->apd_id);
            $data_detail = Apd_detail::create([
                "apd_id" => $request->apd_id,
                "nama_petugas" => $request->nama_petugas,
                "masker" => $request->masker,
                "handschoen" => $request->handschoen,
                "apron" => $request->apron,
                "haircap" => $request->haircap,
                "google" => $request->google,
                "glow" => $request->glow,
                "keterangan" => $request->keterangan,
            ]);

            $period = PeriodeResource::collection(Periode::where('aktif', 'Y')->get());
            $ruangan = RuanganResource::collection(Ruangan::where('aktif', 'Y')->get());
            session()->flash('success', 'Observasi sudah berhasil di proses..');
            return view('observasi.apd.lanjut', [
                "data" => $data,
                "data_detail" => $data_detail,
                "period" => $period,
                "ruangan" => $ruangan
            ]);
        } catch (\Exception $d) {
            session()->flash('error', 'Terjadi Kesalahan....' . $d);
            return redirect()->back();
        }
    }

    public function list()
    {
        $data = Apd::where('posting', 'N')->paginate(15);
        return view(
            'observasi.apd.list',
            [
                "data" => $data,
                "no" => 0
            ]
        );
    }

    public function posting(Request $request)
    {
        try {
            $data = Apd::find($request->id);
            $data->update(["posting" => "Y"]);
            session()->flash('success', 'Observasi sudah berhasil di proses..');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
        }
        return redirect()->back();
    }



    public function detail($id)
    {
        $data = Apd::find($id);
        $data_detail = Apd_detail::where('apd_id', $id)->get();

        return view('observasi.apd.detail', [
            "no" => 0,
            "data" => $data,
            "data_detail" => $data_detail
        ]);
    }
    public function report()
    {
        $data = Apd::where('posting', 'Y')->all();
        return view(
            'observasi.apd.report',
            ["data" => $data]
        );
    }
}