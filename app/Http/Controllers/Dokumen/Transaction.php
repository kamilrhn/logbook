<?php

namespace App\Http\Controllers\Dokumen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\Penagihan;
// use App\Models\Foto;
use App\Models\Kl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Alert;

class Transaction extends Controller
{
    //
    public function store(Request $request)
    {
        //get filename buat foto
        $before = $request->item_desc;
        $replaced = Str::replace('/', '-', $before);

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Ymd');
        $img = $request->image;
        $folderPath = "public/evidence/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_base64 = base64_decode($image_parts[1]);
        $filename = 'Evidence-Submit-'.$tanggal.'_'.$replaced . '.png';
        $file = $folderPath . $filename;
        Storage::put($file, $image_base64);

        //store di table dokumen
        $penagihan = Penagihan::where('no_penagihan', $request->item_desc)->first();
        $dok = new Dokumen();
        $dok->partner_name = $request->partner_name;
        $dok->jenis_dokumen = $request->jenis_dokumen;
        $dok->item_desc = $request->item_desc;
        if($dok->jenis_dokumen == 'BAPL'){
            $dok->item_desc1 = $penagihan->PERIODE_DESC;
        }elseif($dok->jenis_dokumen == 'BAPLA'){
            $dok->item_desc1 = strtoupper($request->item_desc1);
        }
        $dok->status = "Submitted";
        if($dok->jenis_dokumen == 'BA Kronologis'){
            $dok->sign_by = '20';
        }elseif($dok->jenis_dokumen == 'BAPL'){
            $dok->sign_by = $penagihan->sign_by;
        }else{
            $dok->sign_by = $request->sign_by;
        }
        $dok->pic_before = $request->partner_pic;
        $dok->path_before = $filename;
        $dok->save();

        //store KL perpanjangan ke table m_kl
        if($dok->jenis_dokumen == 'BAPLA'){
            $cek_data = Kl::find($request->item_desc1);
            // dd($cek_data);
            if($cek_data == NULL){
                $kl = new KL();
                $kl->no_kl = strtoupper($request->item_desc1);
                $kl->partner_id = Auth::user()->partner_id;
                $kl->status = '20';
                $kl->last_update_by = Auth::user()->id;
                $kl->kl_periode = '1';
                $kl->save();
            }
        }

        Alert::success('Berhasil', 'Dokumen Berhasil Diinput');
        return redirect()->back();
    }

    public function store_kl(Request $request)
    {
        $kl = new Kl();
        $kl->no_kl = strtoupper($request->no_kl);
        $kl->partner_id = Auth::user()->partner_id;
        $kl->status = '20';
        $kl->last_update_by = Auth::user()->id;
        $kl->kl_periode = '1';
        // dd($kl);
        $kl->save();

        Alert::success('Berhasil', 'Berhasil Input Nomor KL');
        return redirect()->back();
    }

    public function store_ambil(Request $request, $id)
    {
        $dok = Dokumen::find($id);
        $before = $dok->item_desc;
        $replaced = Str::replace('/', '-', $before);

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Ymd');

        $img = $request->image;
        $folderPath = "public/evidence/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);

        $image_base64 = base64_decode($image_parts[1]);
        $filename = 'Evidence-Pickup-'.$tanggal.'_'.$replaced . '.png';

        $file = $folderPath . $filename;

        Storage::put($file, $image_base64);
        $dok->status = "Pickup by Mitra";
        $dok->pic_after = $request->partner_pic;
        $dok->path_after = $filename;
        // dd($dok);
        $dok->save();

        Alert::success('Berhasil', 'Dokumen Berhasil Diambil');
        return redirect()->route('dokumen-selesai');
    }
}
