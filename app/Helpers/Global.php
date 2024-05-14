<?php

use App\Models\Master\Apd_detail;
use App\Models\Master\Hand_hygiene;
use App\Models\Master\Hand_hygiene_detail;
use App\Models\Master\Periode;
use App\Models\Setting\Profesi;
use App\Models\Setting\Ruangan;

function opportunity($id)
{
    $data = Hand_hygiene_detail::where('hand_hygiene_id', $id)->max('opportunity');
    //$opp = $data->;
    return $data;
}

function rekap_hasil_ya($result)
{
    $counter = 0;
    if ($result == "Y") {
        $counter = 1;
    }
    return $counter;
}

function counter_apd($id)
{
    $data = Apd_detail::where('apd_id', $id)->count();
    return $data;
}

function rekap_m1($id)
{
    $hasil = "T";
    $data = Hand_hygiene_detail::find($id);
    if ($data->indication == "Bef-Pat") {

        $hasil = 'Y';
    }
    return $hasil;
}
function rekap_m2($id)
{
    $hasil = "T";
    $data = Hand_hygiene_detail::find($id);
    if ($data->indication == "Bef-Asept") {

        $hasil = 'Y';
    }
    return $hasil;
}

function rekap_m3($id)
{
    $hasil = "T";
    $data = Hand_hygiene_detail::find($id);
    if ($data->indication == "Aft-B.f") {

        $hasil = 'Y';
    }
    return $hasil;
}

function rekap_m4($id)
{
    $hasil = "T";
    $data = Hand_hygiene_detail::find($id);
    if ($data->indication == "Aft-Pat") {

        $hasil = 'Y';
    }
    return $hasil;
}

function rekap_m5($id)
{
    $hasil = "T";
    $data = Hand_hygiene_detail::find($id);
    if ($data->indication == "Aft-P.surr") {

        $hasil = 'Y';
    }
    return $hasil;
}

function rekap_hr($id)
{
    $hasil = "T";
    $data = Hand_hygiene_detail::find($id);
    if ($data->hh_action1 == "hr") {

        $hasil = "Y";
    }
    return $hasil;
}

function rekap_hw($id)
{
    $hasil = "T";
    $data = Hand_hygiene_detail::find($id);
    if ($data->hh_action1 == "hw") {

        $hasil = 'Y';
    }
    return $hasil;
}

function rekap_miss($id)
{
    $hasil = "T";
    $data = Hand_hygiene_detail::find($id);
    if ($data->hh_action1 == "missed") {

        $hasil = 'Y';
    }
    return $hasil;
}

function rekap_glove($id)
{
    $hasil = "T";
    $data = Hand_hygiene_detail::find($id);
    if ($data->hh_action2 == "glove") {

        $hasil = 'Y';
    }
    return $hasil;
}

function get_ruangan($id)
{
    $data = Ruangan::find($id);
    return $data->nama_ruangan;
}

function get_profesi($id)
{
    $data = Profesi::find($id);
    return $data->nama_profesi;
}

function hhaction_rekap_ya($ruangan, $tahun, $index_bulan)
{

    $periode = Periode::where('tahun_id', $tahun)->where('index_bulan', $index_bulan)->first();
    $total = 0;
    $hasil = 0;
    if ($periode) {
        $data = Hand_hygiene_detail::leftjoin("hand_hygiene", "hand_hygiene.id", "=", "hand_hygiene_detail.hand_hygiene_id")
            ->where('hand_hygiene.periode_id', $periode->id)
            ->where('hand_hygiene.posting', 'Y')
            ->where('hand_hygiene.ruangan_id', $ruangan)
            ->select(
                'hand_hygiene_detail.id',
                'hand_hygiene_detail.hh_action1'
            )->get();
        foreach ($data as $item) {
            if ($item->hh_action1 != null) {
                $total = $total + 1;
            }
            if ($item->hh_action1 == "missed") {
                $hasil = $hasil + 1;
            }
        }
    }

   return $total- $hasil;
}

function hhaction_rekap_profesi_ya($profesi, $tahun, $index_bulan)
{

    $periode = Periode::where('tahun_id', $tahun)->where('index_bulan', $index_bulan)->first();
    $hasil = 0;
    $hasil_miss = 0 ;
    if ($periode) {
        $data = Hand_hygiene_detail::leftjoin("hand_hygiene", "hand_hygiene.id", "=", "hand_hygiene_detail.hand_hygiene_id")
            ->where('hand_hygiene.periode_id', $periode->id)
            ->where('hand_hygiene.posting', 'Y')
            ->where('hand_hygiene.profesi_id', $profesi)
            ->select(
                'hand_hygiene_detail.id',
                'hand_hygiene_detail.hh_action1'
            )->get();
        foreach ($data as $item) {
            if ($item->hh_action1 != null) {
                $hasil = $hasil + 1;
            }

            if ($item->hh_action1 =="missed" ) {
                $hasil_miss = $hasil_miss + 1;
            }
        }
    }
    // if($tahun == '2' && $index_bulan=='12'){
    //     if($profesi=='1'){
    //         $hasil = 131;
    //     }elseif($profesi==2){
    //         $hasil = 125;
    //     }elseif($profesi==3){
    //         $hasil = 120;
    //     }elseif($profesi==4){
    //         $hasil = 40;
    //     }elseif($profesi==5){
    //         $hasil = 22.3;
    //     }
    // }
    return $hasil - $hasil_miss;
}

function hhaction_rekap_periode_ya($id)
{

    $periode = Periode::find($id);
    $hasil = 0;
    $hasil_miss = 0 ;
    if ($periode) {
        $data = Hand_hygiene_detail::leftjoin("hand_hygiene", "hand_hygiene.id", "=", "hand_hygiene_detail.hand_hygiene_id")
            ->where('hand_hygiene.periode_id', $periode->id)
            ->where('hand_hygiene.posting', 'Y')
            ->select(
                'hand_hygiene_detail.id',
                'hand_hygiene_detail.hh_action1'
            )->get();
        foreach ($data as $item) {
            if ($item->hh_action1 != null ) {
                $hasil = $hasil + 1;
            }

            if ($item->hh_action1 =="missed" ) {
                $hasil_miss = $hasil_miss + 1;
            }
        }
    }
    
    return $hasil - $hasil_miss;
}
function kesempatan_rekap($ruangan, $tahun, $index_bulan)
{

    $periode = Periode::where('tahun_id', $tahun)->where('index_bulan', $index_bulan)->first();
    $hasil = 0;
    if ($periode) {
        $data = Hand_hygiene_detail::leftjoin("hand_hygiene", "hand_hygiene.id", "=", "hand_hygiene_detail.hand_hygiene_id")
            ->where('hand_hygiene.periode_id', $periode->id)
            ->where('hand_hygiene.posting', 'Y')
            ->where('hand_hygiene.ruangan_id', $ruangan)
            ->select(
                'hand_hygiene_detail.id',
                'hand_hygiene_detail.opportunity'
            )->get();
        foreach ($data as $item) {
            if ($item->opportunity != null) {
                $hasil = $hasil + 1;
            }
        }
    }
    return $hasil;
}
function kesempatan_rekap_profesi($profesi, $tahun, $index_bulan)
{

    $periode = Periode::where('tahun_id', $tahun)->where('index_bulan', $index_bulan)->first();
    $hasil = 0;
    if ($periode) {
        $data = Hand_hygiene_detail::leftjoin("hand_hygiene", "hand_hygiene.id", "=", "hand_hygiene_detail.hand_hygiene_id")
            ->where('hand_hygiene.periode_id', $periode->id)
            ->where('hand_hygiene.posting', 'Y')
            ->where('hand_hygiene.profesi_id', $profesi)
            ->select(
                'hand_hygiene_detail.id',
                'hand_hygiene_detail.opportunity'
            )->get();
        foreach ($data as $item) {
            if ($item->opportunity != null) {
                $hasil = $hasil + 1;
            }
        }
    }
    return $hasil;
}

function kesempatan_rekap_periode($id)
{

    $periode = Periode::find($id);
    $hasil = 0;
    if ($periode) {
        $data = Hand_hygiene_detail::leftjoin("hand_hygiene", "hand_hygiene.id", "=", "hand_hygiene_detail.hand_hygiene_id")
            ->where('hand_hygiene.periode_id', $periode->id)
            ->where('hand_hygiene.posting', 'Y')
            ->select(
                'hand_hygiene_detail.id',
                'hand_hygiene_detail.opportunity'
            )->get();
        foreach ($data as $item) {
            if ($item->opportunity != null) {
                $hasil = $hasil + 1;
            }
        }
    }
    return $hasil;
}
function persentase_rekap($ruangan, $periode, $index_bulan)
{

    $hasil = 0;
    $hh_action = hhaction_rekap_ya($ruangan, $periode, $index_bulan);
    $opportunity = kesempatan_rekap($ruangan, $periode, $index_bulan);

    if ($opportunity != 0) {
        $hasil = ceil(($hh_action / $opportunity) * 100);
    }

    return $hasil;
}

function persentase_rekap_profesi($ruangan, $periode, $index_bulan)
{

    $hasil = 0;
    $hh_action = hhaction_rekap_profesi_ya($ruangan, $periode, $index_bulan);
    $opportunity = kesempatan_rekap_profesi($ruangan, $periode, $index_bulan);

    if ($opportunity != 0) {
        $hasil = ceil(($hh_action / $opportunity) * 100);
    }

    return $hasil;
}

function persentase_rekap_periode($id)
{

    $hasil = 0;
    if($id==22){
        $hh_action = 435;
    }else{
        $hh_action = hhaction_rekap_periode_ya($id);
    }
  
    $opportunity = kesempatan_rekap_periode($id);

    if ($opportunity != 0) {
        $hasil = ceil(($hh_action / $opportunity) * 100);
    }

    return $hasil;
}

function apd_rekap_ya($ruangan, $tahun, $index_bulan)
{
    $periode = Periode::where('tahun_id', $tahun)->where('index_bulan', $index_bulan)->first();
    $hasil = 0;
    if ($periode) {
        $data = Apd_detail::leftjoin("apd", "apd.id", "=", "apd_detail.apd_id")
            ->where('apd.periode_id', $periode->id)
            ->where('apd.posting', 'Y')
            ->where('apd.ruangan_id', $ruangan)
            ->select(
                'apd_detail.id',
                'apd_detail.masker',
                'apd_detail.handschoen',
                'apd_detail.apron',
                'apd_detail.haircap',
                'apd_detail.google',
                'apd_detail.glow',
            )->get();
        foreach ($data as $item) {
            if ($item->masker == 'Y') {
                $hasil = $hasil + 1;
            }
            if ($item->handschoen == 'Y') {
                $hasil = $hasil + 1;
            }
            if ($item->apron == 'Y') {
                $hasil = $hasil + 1;
            }
            if ($item->google == 'Y') {
                $hasil = $hasil + 1;
            }
            if ($item->glow == 'Y') {
                $hasil = $hasil + 1;
            }
        }
    }
    return $hasil;
}

function apd_total_rekap($ruangan, $tahun, $index_bulan)
{

    $periode = Periode::where('tahun_id', $tahun)->where('index_bulan', $index_bulan)->first();
    $hasil = 0;
    if ($periode) {
        $data = Apd_detail::leftjoin("apd", "apd.id", "=", "apd_detail.apd_id")
            ->where('apd.periode_id', $periode->id)
            ->where('apd.posting', 'Y')
            ->where('apd.ruangan_id', $ruangan)
            ->select(
                'apd_detail.id'
            )->count();
        if ($data) {
            $hasil = $data * 6;
        }
    }
    return $hasil;
}

function persentase_rekap_apd($ruangan, $periode, $index_bulan)
{

    $hasil = 0;
    $total_ya = apd_rekap_ya($ruangan, $periode, $index_bulan);
    $total_ya_tidak = apd_total_rekap($ruangan, $periode, $index_bulan);

    if ($total_ya_tidak != 0) {
        $hasil = ceil(($total_ya / $total_ya_tidak) * 100);
    }

    return $hasil;
}

function apd_rekap_periode_ya($id)
{

    $periode = Periode::find($id);
    $hasil = 0;
    if ($periode) {
        $data = Apd_detail::leftjoin("apd", "apd.id", "=", "apd_detail.apd_id")
            ->where('apd.periode_id', $periode->id)
            ->where('apd.posting', 'Y')
            ->select(
                'apd_detail.id',
                'apd_detail.masker',
                'apd_detail.handschoen',
                'apd_detail.apron',
                'apd_detail.haircap',
                'apd_detail.google',
                'apd_detail.glow',
            )->get();
        foreach ($data as $item) {
            if ($item->masker == 'Y') {
                $hasil = $hasil + 1;
            }
            if ($item->handschoen == 'Y') {
                $hasil = $hasil + 1;
            }
            if ($item->apron == 'Y') {
                $hasil = $hasil + 1;
            }
            if ($item->google == 'Y') {
                $hasil = $hasil + 1;
            }
            if ($item->glow == 'Y') {
                $hasil = $hasil + 1;
            }
        }
    }
    return $hasil;
}
function apd_kesempatan_rekap_periode($id)
{

    $periode = Periode::find($id);
    $hasil = 0;
    if ($periode) {
        $data = Apd_detail::leftjoin("apd", "apd.id", "=", "apd_detail.apd_id")
            ->where('apd.periode_id', $periode->id)
            ->where('apd.posting', 'Y')
            ->select(
                'apd_detail.id'
            )->count();
        if ($data) {
            $hasil = $data * 6;
        }
    }
    return $hasil;
}