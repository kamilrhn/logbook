<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Auth;

class Beranda extends Controller
{
    //
    public function index(){
        if(Auth::user()->role == 7){
            $d_selesai = Dokumen::where('m_dokumen_pevita.sign_by', '10')->where('m_dokumen_pevita.status', 'Pickup by Mitra')->get();
            $c_selesai = $d_selesai->count();
            $c_aktif = Dokumen::where('sign_by', '10')->whereIn('status', ['Done TTD Manager', 'Done TTD SM'])->count();
    
            $c_bapl = Dokumen::where('sign_by', '10')->where('jenis_dokumen', 'BAPL')->count();
            $c_bapla = Dokumen::where('sign_by', '10')->where('jenis_dokumen', 'BAPLA')->count();
            $c_bak = Dokumen::where('sign_by', '10')->where('jenis_dokumen', 'BA Kronologis')->count();
            $c_lainnya = Dokumen::where('sign_by', '10')->whereNotIn('jenis_dokumen', ['BAPL', 'BAPLA', 'BA Kronologis'])->count();
    
        }elseif(Auth::user()->role == 2){
            $d_selesai = Dokumen::where('m_dokumen_pevita.status', 'Pickup by Mitra')->where('m_dokumen_pevita.partner_name', Auth::user()->partner->partner_name)->get();
            $c_selesai = $d_selesai->count();
            $c_aktif = Dokumen::whereIn('status', ['Done TTD Manager', 'Done TTD SM'])->where('partner_name', Auth::user()->partner->partner_name)->count();
    
            $c_bapl = Dokumen::where('jenis_dokumen', 'BAPL')->where('partner_name', Auth::user()->partner->partner_name)->count();
            $c_bapla = Dokumen::where('jenis_dokumen', 'BAPLA')->where('partner_name', Auth::user()->partner->partner_name)->count();
            $c_bak = Dokumen::where('jenis_dokumen', 'BA Kronologis')->where('partner_name', Auth::user()->partner->partner_name)->count();
            $c_lainnya = Dokumen::whereNotIn('jenis_dokumen', ['BAPL', 'BAPLA', 'BA Kronologis'])->where('partner_name', Auth::user()->partner->partner_name)->count();
        }else{
            $d_selesai = Dokumen::where('m_dokumen_pevita.status', 'Pickup by Mitra')->get();
            $c_selesai = $d_selesai->count();
            $c_aktif = Dokumen::whereIn('status', ['Done TTD Manager', 'Done TTD SM'])->count();
    
            $c_bapl = Dokumen::where('jenis_dokumen', 'BAPL')->count();
            $c_bapla = Dokumen::where('jenis_dokumen', 'BAPLA')->count();
            $c_bak = Dokumen::where('jenis_dokumen', 'BA Kronologis')->count();
            $c_lainnya = Dokumen::whereNotIn('jenis_dokumen', ['BAPL', 'BAPLA', 'BA Kronologis'])->count();
    
        }
      
        return view('beranda.index', compact('c_aktif', 'c_bapl', 'c_bak', 'c_bapla', 
                    'c_lainnya', 'd_selesai', 'c_selesai'));
    }
}
