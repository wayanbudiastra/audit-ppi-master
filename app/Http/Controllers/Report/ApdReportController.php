<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Master\Periode;
use App\Models\Setting\Profesi;
use App\Models\Setting\Report_config;
use App\Models\Setting\Ruangan;
use App\Models\Setting\Tahun;
use Illuminate\Http\Request;

class ApdReportController extends Controller
{
    //
    public function rekap_perruangan(){
        $report_config = Report_config::find(1);
        $period = Tahun::where('aktif','Y')->get();
        $periode = Periode::where('tahun_id',$report_config->hh_rekap_perruangan)->first();
        $ruangan = Ruangan::where('aktif','Y')->get();
        $tahun = Tahun::where('id', $report_config->hh_rekap_perruangan)->first();

        return view('report.apd.ruangan',[
            "no"=>0,
            "period"=> $period,
            "periode"=> $periode,
            "ruangan"=> $ruangan,
            "tahun"=> $tahun,
            "periode_id"=> $tahun->id
        ]);
    }

    public function rekap_perruangan_tahun(Request $request){

        $period = Tahun::where('aktif','Y')->get();
        $periode = Periode::where('tahun_id',$request->tahun_id)->first();
        $ruangan = Ruangan::where('aktif','Y')->get();
        $tahun = Tahun::where('id', $request->tahun_id)->first();

        return view('report.apd.ruangan',[
            "no"=>0,
            "period"=> $period,
            "periode"=> $periode,
            "ruangan"=> $ruangan,
            "tahun"=> $tahun,
            "periode_id"=> $tahun->id
        ]);
    }
   

    public function rekap_perperiode(){
        $report_config = Report_config::find(1);
        $period = Tahun::where('aktif', 'Y')->get();
        $tahun  = Tahun::where('id', $report_config->hh_rekap_perperiode)->first();
        $ruangan = Ruangan::where('aktif', 'Y')->get();
        $periode = Periode::where('tahun_id',$tahun->id)->get();
        //dd($periode);

        return view('report.apd.periode', [
            "no" => 0,
            "tahun" => $tahun,
            "period" => $period,
            "periode_id" => $tahun->id,
            "ruangan" => $ruangan,
            "periode"=> $periode
        ]);
    }

    public function rekap_perperiode_tahun(Request $request){
       
        $period = Tahun::where('aktif', 'Y')->get();
        $tahun  = Tahun::where('id', $request->tahun_id)->first();
        $ruangan = Ruangan::where('aktif', 'Y')->get();
        $periode = Periode::where('tahun_id',$request->tahun_id)->get();
        //dd($periode);

        return view('report.apd.periode', [
            "no" => 0,
            "tahun" => $tahun,
            "period" => $period,
            "periode_id" => $tahun->id,
            "ruangan" => $ruangan,
            "periode"=> $periode
        ]);
    }
}
