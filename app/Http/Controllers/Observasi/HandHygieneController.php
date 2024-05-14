<?php

namespace App\Http\Controllers\Observasi;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeriodeResource;
use App\Http\Resources\ProfesiResource;
use App\Http\Resources\RuanganResource;
use App\Models\Master\Hand_hygiene;
use App\Models\Master\Hand_hygiene_detail;
use App\Models\Master\Periode;
use App\Models\Setting\Profesi;
use App\Models\Setting\Ruangan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HandHygieneController extends Controller
{
    //
    public function mulai()
    {

        $period = PeriodeResource::collection(Periode::where('aktif', 'Y')->orderby('id','desc')->get());
        $ruangan = RuanganResource::collection(Ruangan::where('aktif', 'Y')->orderby('id','desc')->get());
        $profesi = ProfesiResource::collection(Profesi::where('aktif', 'Y')->orderby('id','desc')->get());

        return view('observasi.hand.index', [
            "period" => $period,
            "ruangan" => $ruangan,
            "profesi" => $profesi
        ]);
    }

    public function simpan_satu(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "periode" => 'required',
            "lantai" => 'required',
            "ruangan_id" => 'required',
            "observer" => 'required',
            "tanggal_observasi" => 'required',
            "profesi_id" => 'required',
            "waktu_start" => 'required',
            "waktu_end" => 'required',
            "indication" => 'required',

        ]);
        try {
            $data = Hand_hygiene::create([
                "periode_id" => $request->periode,
                "lantai" => $request->lantai,
                "ruangan_id" => $request->ruangan_id,
                "observer" => $request->observer,
                "tanggal_observasi" => $request->tanggal_observasi,
                "profesi_id" => $request->profesi_id,
                "waktu_start" => $request->waktu_start,
                "waktu_end" => $request->waktu_end
            ]);

            $data_detail = Hand_hygiene_detail::create([
                "hand_hygiene_id" => $data->id,
                "opportunity" => 1,
                "indication" => $request->indication,
                "hh_action1" => $request->hh_action1,
                "hh_action2" => $request->hh_action2,
            ]);
            // if($request->hh_action1=='missed'){
                // $data_detail = Hand_hygiene_detail::create([
                //     "hand_hygiene_id" => $data->id,
                //     "opportunity" => 1,
                //     "indication" => $request->indication,
                //     "hh_action1" => $request->hh_action1,
                //     "hh_action2" => $request->hh_action2,
                // ]);
              
            // }else{
            //     $data_detail = Hand_hygiene_detail::create([
            //         "hand_hygiene_id" => $data->id,
            //         "opportunity" => 1,
            //         "indication" => $request->indication,
            //         "hh_action1" => '',
            //         "hh_action2" => $request->hh_action1,
            //     ]);
           // }
          
            $period = PeriodeResource::collection(Periode::where('aktif', 'Y')->orderby('id','desc')->get());
            $ruangan = RuanganResource::collection(Ruangan::where('aktif', 'Y')->orderby('id','desc')->get());
            $profesi = ProfesiResource::collection(Profesi::where('aktif', 'Y')->orderby('id','desc')->get());

            session()->flash('success', 'Observasi sudah berhasil di proses..');
            return view('observasi.hand.lanjut', [
                "data" => $data,
                "data_detail" => $data_detail,
                "period" => $period,
                "ruangan" => $ruangan,
                "profesi" => $profesi
            ]);
        } catch (\Exception $d) {
            session()->flash('error', 'Terjadi Kesalahan..' . $d);
            return redirect()->back();
        }
    }

    public function lanjut(Request $request)
    {
        
        // $request->validate([
        //     "indication" => 'required',
        // ]);
        try {
            $data = Hand_hygiene::find($request->hand_hygiene_id);
            $data_detail = Hand_hygiene_detail::create([
                "hand_hygiene_id" => $request->hand_hygiene_id,
                "opportunity" => $request->opportunity + 1,
                "indication" => $request->indication,
                "hh_action1" => $request->hh_action1,
                "hh_action2" => $request->hh_action2,
            ]);
            $period = PeriodeResource::collection(Periode::where('aktif', 'Y')->orderby('id','desc')->get());
            $ruangan = RuanganResource::collection(Ruangan::where('aktif', 'Y')->orderby('id','desc')->get());
            $profesi = ProfesiResource::collection(Profesi::where('aktif', 'Y')->orderby('id','desc')->get());

            session()->flash('success', 'Observasi sudah berhasil di proses..');
            if ($request->opportunity < 6) {
                return view('observasi.hand.lanjut', [
                    "data" => $data,
                    "data_detail" => $data_detail,
                    "period" => $period,
                    "ruangan" => $ruangan,
                    "profesi" => $profesi
                ]);
            } else {
                return redirect('/handhygiene-list');
            }
        } catch (\Exception $d) {
            session()->flash('error', 'Terjadi Kesalahan..' . $d);
            return route('home');
        }
    }

    public function list()
    {

        $data = Hand_hygiene::where('posting', 'N')->orderby('id', 'desc')->paginate(10);
        //dd($data);
        return view('observasi.hand.list', [
            "data" => $data,
            "no" => 0
        ]);
    }

    public function posting(Request $request)
    {
        try {
            $data = Hand_hygiene::find($request->id);
            $data->update(["posting" => "Y"]);
            session()->flash('success', 'Observasi HH sudah berhasil di proses..');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
        }
        return redirect()->back();

        // $data = Hand_hygiene::find($request->id);
        // dd($data);
    }

    public function lanjut_input($id)
    {
        //dd($id);
        try {
            $data = Hand_hygiene::find($id);
            $data_detail = Hand_hygiene_detail::where('hand_hygiene_id', $id)->orderby('id', 'desc')->first();
            $period = PeriodeResource::collection(Periode::where('aktif', 'Y')->orderby('id','desc')->get());
            $ruangan = RuanganResource::collection(Ruangan::where('aktif', 'Y')->orderby('id','desc')->get());
            $profesi = ProfesiResource::collection(Profesi::where('aktif', 'Y')->orderby('id','desc')->get());
            return view('observasi.hand.lanjut', [
                "data" => $data,
                "data_detail" => $data_detail,
                "period" => $period,
                "ruangan" => $ruangan,
                "profesi" => $profesi
            ]);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan....' . $e);
            return redirect()->back();
        }
    }

    public function report()
    {
        $data = Hand_hygiene::where('posting', 'Y')->get();
        return view(
            'observasi.hand.report',
            ["data" => $data]
        );
    }
}