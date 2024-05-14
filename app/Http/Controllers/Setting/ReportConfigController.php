<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Report_config;
use App\Models\Setting\Tahun;
use Illuminate\Http\Request;

class ReportConfigController extends Controller
{
    //
    public function index()
    {
        $data = Report_config::find(1);
        $tahun = Tahun::where('aktif', 'Y')->get();
        $aksi = url('report-store');
        return view('setting.report_config.index', [
            "hh_rekap_permoment" => $data->hh_rekap_permoment,
            "hh_rekap_perruangan" => $data->hh_rekap_perruangan,
            "hh_rekap_perperiode" => $data->hh_rekap_perperiode,
            "tahun" => $tahun,
            "aksi" => $aksi,
            "no" => 0
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = Report_config::find($request->id);
            $data->update([
                "hh_rekap_permoment" => $request->hh_rekap_permoment,
                "hh_rekap_perruangan" => $request->hh_rekap_perruangan,
                "hh_rekap_perperiode" => $request->hh_rekap_perperiode,
            ]);
            session()->flash('success', 'Data sudah berhasil di proses..');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
        }
        return redirect()->back();
    }
}