<?php

namespace App\Http\Controllers\Dokumen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Alert;
use Telegram\Bot\Laravel\Facades\Telegram;
use Twilio\Rest\Client;

class Status extends Controller
{
    //
  public function received($id)
  {
    $dok = Dokumen::find($id);
    $dok->received = Auth::user()->name;
    $dok->status = 'Received by SLG';
    $dok->save();

    Alert::success('Update Status', 'Berhasil Update Status');
    return redirect()->back();
  }

  public function proses_manager($id)
  {
    $dok = Dokumen::find($id);
    $dok->received = Auth::user()->name;
    $dok->status = 'Proses Manager';
    $dok->save();

    Alert::success('Update Status', 'Berhasil Update Status');
    return redirect()->back()->with('message','Data added Successfully');
  }

  public function done_ttd_manager($id)
  {
    $dok = Dokumen::find($id);
    $dok->received = Auth::user()->name;
    $dok->status = 'Done TTD Manager';
    $dok->save();

    $data = User::where('name', $dok->partner_name)->first();
    // dd($data->telegram);

    $text = "Hi ".$dok->partner_name.". Dokumen ".$dok->jenis_dokumen." dengan Nomor Dokumen ".$dok->item_desc.
    " sudah selesai sirkulir. Silahkan diambil segera ya.";

    Telegram::sendMessage([
      'chat_id' => $data->telegram,
      'parse_mode' => 'HTML',
      'text' => $text
    ]);

    // if($dok->partner_name == 'DATALINK SOLUTION'){
    //   Telegram::sendMessage([
    //     'chat_id' => '-1001866041459',
    //     'parse_mode' => 'HTML',
    //     'text' => $text
    //   ]);
    // }else{
    //   Telegram::sendMessage([
    //     'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
    //     'parse_mode' => 'HTML',
    //     'text' => $text
    //   ]);
    // }

    $sid    = getenv("TWILIO_AUTH_SID");
    $token  = getenv("TWILIO_AUTH_TOKEN");
    $wa_from= getenv("TWILIO_WHATSAPP_FROM");
    $twilio = new Client($sid, $token);

    $text = "Hi ".$dok->partner_name.". Dokumen ".$dok->jenis_dokumen." dengan Nomor Dokumen ".$dok->item_desc.
    " sudah selesai sirkulir. Silahkan diambil segera ya.";

    $recipient = '+6283871894872';

    $twilio->messages->create("whatsapp:$recipient",["from" => "whatsapp:$wa_from", "body" => $text]);

    Alert::success('Update Status', 'Berhasil Update Status');
    return redirect()->back()->with('message','Data added Successfully');
  }

  public function done_paraf_manager($id)
  {
    $dok = Dokumen::find($id);
    $dok->received = Auth::user()->name;
    $dok->status = 'Done Paraf Manager';
    $dok->save();

    Alert::success('Update Status', 'Berhasil Update Status');
    return redirect()->back()->with('message','Data added Successfully');
  }

  public function received_sm($id)
  {
    $dok = Dokumen::find($id);
    $dok->received = Auth::user()->name;
    $dok->status = 'Received by SM Staff';
    $dok->save();

    Alert::success('Update Status', 'Berhasil Update Status');
    return redirect()->back()->with('message','Data added Successfully');
  }

  public function proses_sm($id)
  {
    $dok = Dokumen::find($id);
    $dok->received = Auth::user()->name;
    $dok->status = 'Proses TTD SM';
    $dok->save();

    Alert::success('Update Status', 'Berhasil Update Status');
    return redirect()->back()->with('message','Data added Successfully');
  }

  public function done_sm($id)
  {
    $dok = Dokumen::find($id);
    $dok->received = Auth::user()->name;
    $dok->status = 'Done TTD SM';
    $dok->save();

    $data = User::where('name', $dok->partner_name)->first();
    // dd($data->telegram);

    $text = "Hi ".$dok->partner_name.". Dokumen ".$dok->jenis_dokumen." dengan Nomor Dokumen ".$dok->item_desc.
    " sudah selesai sirkulir. Silahkan diambil segera ya.";

    Telegram::sendMessage([
      'chat_id' => $data->telegram,
      'parse_mode' => 'HTML',
      'text' => $text
    ]);

    Alert::success('Update Status', 'Berhasil Update Status');
    return redirect()->back()->with('message','Data added Successfully');
  }
}
