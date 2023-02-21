<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kl;
use App\Models\Surat;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Illuminate\Support\Facades\Auth;
use Alert;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class Index extends Controller
{
    //

    public function request()
    {
        $m_kl = Kl::all();
        return view('surat.request', compact('m_kl'));
    }

    public function store_bapla(Request $request)
    {
        $surat = new Surat();
        $surat->jenis = 'BAPLA';
        $surat->status = 'Requested';
        $surat->sign_by = $request->sign_by;
        $surat->item_desc = $request->item_desc;
        $surat->created_by = Auth::user()->name;
        // dd($surat);
        $surat->save();

        Alert::success('Berhasil', 'Permohonan Nomor Surat Telah Dikirim');
        return redirect()->back();
    }

    public function store_lainnya(Request $request)
    {
        $surat = new Surat();
        $surat->jenis = 'Lainnya';
        $surat->status = 'Requested';
        $surat->sign_by = $request->sign_by;
        $surat->item_desc = $request->item_desc;
        $surat->created_by = Auth::user()->name;
        // dd($surat);
        $surat->save();

        Alert::success('Berhasil', 'Permohonan Nomor Surat Telah Dikirim');
        return redirect()->back();
    }

    public function inbox()
    {
        // dd(Auth::check());
        if(Auth::user()->role == 2){
            $surat_req = Surat::where('status', 'Requested')->where('created_by', Auth::user()->partner->partner_name)->get();
            $surat_done = Surat::where('status', 'Done')->where('created_by', Auth::user()->partner->partner_name)->get();
        }else{
            $surat_req = Surat::where('status', 'Requested')->get();
            $surat_done = Surat::where('status', 'Done')->get();
        }
        return view('surat.inbox', compact('surat_req', 'surat_done'));
    }

    public function generate($id)
    {
        $surat = Surat::findOrFail($id);
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tahun = $date->format('Y');
        
        if($surat->sign_by == '10'){
            $suffix = '/YN 000/SDA-B4010000/'.$tahun;
            $generate = UniqueIdGenerator::generate(['table' => 'm_surat', 'field' => 'nomor', 'length' => 35, 'reset_on_change'=>'suffix', 'prefix' => 'C.Tel.', 'suffix'=>$suffix]);
            // dd($generate);
        }else{
            $suffix = '/YN 000/SDA-B4017000/'.$tahun;
            $generate = UniqueIdGenerator::generate(['table' => 'm_surat', 'field' => 'nomor', 'length' => 35, 'reset_on_change'=>'suffix', 'prefix' => 'C.Tel.', 'suffix'=>$suffix]);
            // dd($generate);
        }
        $surat->nomor = $generate;
        $surat->status ='Done';
        $surat->save();
        // dd($surat);
        Alert::success('Berhasil', 'Nomor Surat Berhasil Diterbitkan');
        return redirect()->back();
    }
}
