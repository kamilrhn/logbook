<?php

namespace App\Http\Controllers\Dokumen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\Partner;
use App\Models\Penagihan;
use App\Models\Kl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class View extends Controller
{
    //
    public function dokumen_selesai()
    {
        if(Auth::user()->role == 7){
            $route = 'aktif';
            $data = Dokumen::where('m_dokumen_pevita.sign_by', '10')->whereIn('m_dokumen_pevita.status', ['Done TTD Manager', 'Done TTD SM'])->get();
        }elseif(Auth::user()->role == 2){
            $route = 'aktif';
            $data = Dokumen::whereIn('m_dokumen_pevita.status', ['Done TTD Manager', 'Done TTD SM'])->where('m_dokumen_pevita.partner_name', Auth::user()->partner->partner_name)->get();
        }else{
            $route = 'aktif';
            $data = Dokumen::whereIn('m_dokumen_pevita.status', ['Done TTD Manager', 'Done TTD SM'])->get();
        }

        return view('dokumen.daftar', compact('data', 'route'));
    }

    public function daftar()
    {
        if(Auth::user()->role == 7){
            $data2 = DB::table('m_dokumen_pevita')
                        ->rightJoin('t_penagihan', 'm_dokumen_pevita.item_desc', '=', 't_penagihan.NO_PENAGIHAN')
                        ->where('m_dokumen_pevita.jenis_dokumen', 'BAPL')
                        ->where('m_dokumen_pevita.sign_by', '10')
                        ->select('m_dokumen_pevita.*', 't_penagihan.NO_KL')
                        ->get();
            // dd($data2);
            $data = Dokumen::where('sign_by', '10')->get();
            $data_bapl = $data2->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
            $data_bak = $data->where('jenis_dokumen', 'BA Kronologis')
            ->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
            $data_bapla = $data->where('jenis_dokumen', 'BAPLA')
            ->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
            $data_lainnya = $data->whereNotIn('jenis_dokumen', ['BAPL', 'BA Kronologis', 'BAPLA'])
            ->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
        }elseif(Auth::user()->role == 2){
            $data2 = DB::table('m_dokumen_pevita')
                        ->rightJoin('t_penagihan', 'm_dokumen_pevita.item_desc', '=', 't_penagihan.NO_PENAGIHAN')
                        ->where('m_dokumen_pevita.jenis_dokumen', 'BAPL')
                        ->where('m_dokumen_pevita.partner_name', Auth::user()->partner->partner_name)
                        ->select('m_dokumen_pevita.*', 't_penagihan.NO_KL')
                        ->get();
            $data = Dokumen::where('partner_name', Auth::user()->partner->partner_name)->get();
            $data_bapl =$data2->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
            $data_bak = $data->where('jenis_dokumen', 'BA Kronologis')
            ->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
            $data_bapla = $data->where('jenis_dokumen', 'BAPLA')
            ->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
            $data_lainnya = $data->whereNotIn('jenis_dokumen', ['BAPL', 'BA Kronologis', 'BAPLA'])
            ->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
        }else{
            $data2 = DB::table('m_dokumen_pevita')
                        ->rightJoin('t_penagihan', 'm_dokumen_pevita.item_desc', '=', 't_penagihan.NO_PENAGIHAN')
                        ->where('m_dokumen_pevita.jenis_dokumen', 'BAPL')
                        ->select('m_dokumen_pevita.*', 't_penagihan.NO_KL')
                        ->get();
            $data = Dokumen::all();
            $data_bapl =$data2->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
            $data_bak = $data->where('jenis_dokumen', 'BA Kronologis')
            ->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
            $data_bapla = $data->where('jenis_dokumen', 'BAPLA')
            ->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
            $data_lainnya = $data->whereNotIn('jenis_dokumen', ['BAPL', 'BA Kronologis', 'BAPLA'])
            ->whereNotIn('status', ['Done TTD Manager', 'Done TTD SM', 'Pickup by Mitra', 'Return to Mitra'])->all();
        }
       
        return view('dokumen.daftar_2', compact('data_bapl', 'data_bak', 'data_bapla', 'data_lainnya'));
    }

    public function submit_dokumen()
    {
        if(Auth::user()->role == 2){
            $partner = Partner::where('id_partner', Auth::user()->partner_id)->get();
            $no_penagihan = Penagihan::where('CREATE_BY', Auth::user()->id)->get();
            $m_kl = Kl::where('partner_id', Auth::user()->partner_id)->get();
        }else{
            $partner = Partner::all();
            $no_penagihan = Penagihan::all();
            $m_kl = Kl::all();
        }

        return view('dokumen.submit', compact('partner', 'no_penagihan', 'm_kl'));
    }

    public function ambil_dokumen($id)
    {
        $data = Dokumen::find($id);

        return view('dokumen.ambil', compact('data'));
    }
}
