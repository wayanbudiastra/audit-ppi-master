<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Master\Hand_hygiene;
use App\Models\Master\Hand_hygiene_detail;
use App\Models\Master\Periode;
use App\Models\Setting\Profesi;
use App\Models\Setting\Report_config;
use App\Models\Setting\Ruangan;
use App\Models\Setting\Tahun;
use Exception;
use Illuminate\Http\Request;

class HandReportController extends Controller
{
    //
    public function rekap_permoment()
    {
        $report_config = Report_config::find(1);
        $period = Periode::where('aktif', 'Y')->get();
        $periode  = Periode::where('aktif', 'Y')->where('tahun_id', $report_config->hh_rekap_permoment)->first();
        $data = Hand_hygiene::where('posting', 'Y')->get();
        $periode_id = $periode->id;

        $data_detail = Hand_hygiene_detail::leftjoin("hand_hygiene", "hand_hygiene.id", "=", "hand_hygiene_detail.hand_hygiene_id")
            ->where('hand_hygiene.posting', 'Y')
            ->where('hand_hygiene.periode_id', $periode->id)
            ->select(
                'hand_hygiene_detail.id',
                'hand_hygiene_detail.opportunity',
                'hand_hygiene.tanggal_observasi',
                'hand_hygiene.lantai',
                'hand_hygiene.profesi_id',
                'hand_hygiene.ruangan_id',
                'hand_hygiene.observer',
            )->get();

        //  dd($data_detail);
        return view('report.hand.moment', [
            "no" => 0,
            "periode" => $periode,
            "data" => $data_detail,
            "period" => $period,
            "periode_id" => $periode->id,
        ]);
    }

    public function rekap_permoment_periode(Request $request)
    {

        $report_config = Report_config::find(1);
        $period = Periode::where('aktif', 'Y')->get();
        $periode  = Periode::where('aktif', 'Y')->where('tahun_id', $report_config->hh_rekap_permoment)->first();
        $data = Hand_hygiene::where('posting', 'Y')->get();


        $data_detail = Hand_hygiene_detail::leftjoin("hand_hygiene", "hand_hygiene.id", "=", "hand_hygiene_detail.hand_hygiene_id")
            ->where('hand_hygiene.posting', 'Y')
            ->where('hand_hygiene.periode_id', $request->periode_id)
            ->select(
                'hand_hygiene_detail.id',
                'hand_hygiene_detail.opportunity',
                'hand_hygiene.tanggal_observasi',
                'hand_hygiene.lantai',
                'hand_hygiene.profesi_id',
                'hand_hygiene.ruangan_id',
                'hand_hygiene.observer',
            )->get();

        //  dd($data_detail); ->orderby('hand_hygiene.tanggal_observasi','ASC')
        return view('report.hand.moment', [
            "no" => 0,
            "periode" => $periode,
            "data" => $data_detail,
            "period" => $period,
            "periode_id" => $request->periode_id
        ]);
    }

    public function hh_delete($id)
    {
        try {
            $data = Hand_hygiene_detail::find($id);
            // dd($data);
            $data->delete();
            return redirect()->to('/report-hh-permoment');
        } catch (Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect()->to('/report-hh-permoment');
        }
    }

    public function hh_edit($id)
    {
        try {
            $data = Hand_hygiene_detail::find($id);
            if ($data->indication == "Bef-Pat") {
                $indication_1 = "checked";
                $indication_2 = "";
                $indication_3 = "";
                $indication_4 = "";
                $indication_5 = "";
            } elseif ($data->indication == "Bef-Asept") {
                $indication_1 = "";
                $indication_2 = "checked";
                $indication_3 = "";
                $indication_4 = "";
                $indication_5 = "";
            } elseif ($data->indication == "Aft-B.f") {
                $indication_1 = "";
                $indication_2 = "";
                $indication_3 = "checked";
                $indication_4 = "";
                $indication_5 = "";
            } elseif ($data->indication == "Aft-Pat") {
                $indication_1 = "";
                $indication_2 = "";
                $indication_3 = "";
                $indication_4 = "checked";
                $indication_5 = "";
            } elseif ($data->indication == "Aft-P.surr") {
                $indication_1 = "";
                $indication_2 = "";
                $indication_3 = "";
                $indication_4 = "";
                $indication_5 = "checked";
            } else {
                $indication_1 = "";
                $indication_2 = "";
                $indication_3 = "";
                $indication_4 = "";
                $indication_5 = "";
            }


            if ($data->hh_action1 == "hr") {
                $hh_action1_a = "checked";
                $hh_action1_b = "";
            } elseif ($data->hh_action1 == "hw") {
                $hh_action1_a = "";
                $hh_action1_b = "checked";
            } else {
                $hh_action1_a = "";
                $hh_action1_b = "";
            }

            if ($data->hh_action2 == "missed") {
                $hh_action2_a = "checked";
                $hh_action2_b = "";
            } elseif ($data->hh_action2 == "glove") {
                $hh_action2_a = "";
                $hh_action2_b = "checked";
            } else {
                $hh_action2_a = "";
                $hh_action2_b = "";
            }




            return view('report.hand.edit-moment', [
                "no" => 0,
                "data" => $data,
                "indication_1" => $indication_1,
                "indication_2" => $indication_2,
                "indication_3" => $indication_3,
                "indication_4" => $indication_4,
                "indication_5" => $indication_5,
                "hh_action1_a" => $hh_action1_a,
                "hh_action1_b" => $hh_action1_b,
                "hh_action2_a" => $hh_action2_a,
                "hh_action2_b" => $hh_action2_b,

            ]);
        } catch (Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect()->back();
        }
    }

    public function hh_edit_store(Request $request)
    {
        // dd($request->all());
        try {
            $data = Hand_hygiene_detail::find($request->id);
            $data->update([
                "indication" => $request->indication,
                "hh_action1" => $request->hh_action1,
                "hh_action2" => $request->hh_action2,
            ]);
        } catch (Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
        }
        return redirect()->to('/report-hh-permoment');
    }

    public function rekap_perruangan()
    {
        $report_config = Report_config::find(1);
        $period = Tahun::where('aktif', 'Y')->get();
        $tahun  = Tahun::where('id', $report_config->hh_rekap_perruangan)->first();
        $ruangan = Ruangan::where('aktif', 'Y')->get();


        return view('report.hand.ruangan', [
            "no" => 0,
            "tahun" => $tahun,
            "period" => $period,
            "periode_id" => $tahun->id,
            "ruangan" => $ruangan
        ]);
    }

    public function rekap_perruangan_tahun(Request $request)
    {
        $period = Tahun::where('aktif', 'Y')->get();
        $tahun  = Tahun::find($request->tahun_id);
        $ruangan = Ruangan::where('aktif', 'Y')->get();
        //  $data = Hand_hygiene::where('posting', 'Y')->where('periode_id', $tahun->id)->get();

        return view('report.hand.ruangan', [
            "no" => 0,
            "tahun" => $tahun,
            //  "data" => $data,
            "period" => $period,
            "periode_id" => $tahun->id,
            "ruangan" => $ruangan
        ]);
    }

    public function rekap_perprofesi()
    {
        $report_config = Report_config::find(1);
        $period = Tahun::where('aktif', 'Y')->get();
        $periode = Periode::where('tahun_id', $report_config->hh_rekap_perruangan)->first();
        $profesi = Profesi::where('aktif', 'Y')->get();
        $tahun = Tahun::where('id', $report_config->hh_rekap_perruangan)->first();

        return view('report.hand.profesi', [
            "no" => 0,
            "period" => $period,
            "periode" => $periode,
            "profesi" => $profesi,
            "tahun" => $tahun,
            "periode_id" => $tahun->id
        ]);
    }

    public function rekap_perprofesi_tahun(Request $request)
    {

        $period = Tahun::where('aktif', 'Y')->get();
        $periode = Periode::where('tahun_id', $request->tahun_id)->first();
        $profesi = Profesi::where('aktif', 'Y')->get();
        $tahun = Tahun::where('id', $request->tahun_id)->first();
        return view('report.hand.profesi', [
            "no" => 0,
            "period" => $period,
            "periode" => $periode,
            "profesi" => $profesi,
            "tahun" => $tahun,
            "periode_id" => $tahun->id
        ]);
    }

    public function rekap_perperiode()
    {
        $report_config = Report_config::find(1);
        $period = Tahun::where('aktif', 'Y')->get();
        $tahun  = Tahun::where('id', $report_config->hh_rekap_perperiode)->first();
        $ruangan = Ruangan::where('aktif', 'Y')->get();
        $periode = Periode::where('tahun_id', $tahun->id)->get();
        //dd($periode);

        return view('report.hand.periode', [
            "no" => 0,
            "tahun" => $tahun,
            "period" => $period,
            "periode_id" => $tahun->id,
            "ruangan" => $ruangan,
            "periode" => $periode
        ]);
    }

    public function rekap_perperiode_tahun(Request $request)
    {
        $period = Tahun::where('aktif', 'Y')->get();
        $tahun  = Tahun::where('aktif', 'Y')->first();
        $ruangan = Ruangan::where('aktif', 'Y')->get();
        $periode = Periode::where('tahun_id', $request->tahun_id)->get();
        //dd($periode);

        return view('report.hand.periode', [
            "no" => 0,
            "tahun" => $tahun,
            "period" => $period,
            "periode_id" => $request->tahun_id,
            "ruangan" => $ruangan,
            "periode" => $periode
        ]);
    }
}