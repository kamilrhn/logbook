@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Daftar Dokumen')

@section('vendor-styles')
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
@include('toastr')
<section id="nav-justified">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Daftar Dokumen</h4>
        </div>
        <div class="card-body">
          <p>

          </p>
          <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#daftar-bapl" role="tab"
                aria-controls="daftar-bapl" aria-selected="true">
                BAPL
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#daftar-bak" role="tab"
                aria-controls="daftar-bak" aria-selected="true">
                BA Kronologis
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="messages-tab-justified" data-toggle="tab" href="#daftar-bapla" role="tab"
                aria-controls="daftar-bapla" aria-selected="false">
                BAPLA
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#daftar-lainnya" role="tab"
                aria-controls="daftar-lainnya" aria-selected="false">
                Lainnya
              </a>
            </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content pt-1">
            <div class="tab-pane active" id="daftar-bapl" role="tabpanel" aria-labelledby="home-tab-justified">
              <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                  <thead>
                    <tr>
                      <th>Mitra</th>
                      <th>Dokumen</th>
                      <th>Status</th>
                      <th>PIC</th>
                      <th>Diterima</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data_bapl as $ds)
                    {{-- @foreach($data as $ds) --}}
                    <tr>
                      <td>{{$ds->partner_name}}</td>
                      <td>
                        <strong>Dokumen : </strong>{{$ds->jenis_dokumen}}</br>
                        <strong>No Penagihan : </strong> {{$ds->item_desc}} <br>
                        <strong>Periode : </strong> {{$ds->NO_KL}} - {{$ds->item_desc1}}<br>
                        @if($ds->sign_by == '10')
                        <strong>Penandatangan : </strong>OSM
                        @else
                        <strong>Penandatangan : </strong>Manager
                        @endif
                      </td>
                      @if($ds->status == 'Submitted')
                      <td>
                        <h5 class="badge badge-light-primary">Submitted</h5>
                      </td>
                      @elseif($ds->status == 'Received by SLG')
                      <td>
                        <h5 class="badge badge-light-info">Diterima Staff SLG</h5>
                      </td>
                      @elseif($ds->status == 'Proses Manager')
                      <td>
                        <h5 class="badge badge-light-info">Diproses Manager</h5>
                      </td>
                      @elseif($ds->status == 'Done TTD Manager')
                      <td>
                        <h5 class="badge badge-light-warning">Selesai TTD Manager</h5>
                      </td>
                      @elseif($ds->status == 'Done Paraf Manager')
                      <td>
                        <h5 class="badge badge-light-secondary">Selesai Paraf Manager</h5>
                      </td>
                      @elseif($ds->status == 'Received by SM Staff')
                      <td>
                        <h5 class="badge badge-light-primary">Diterima Staff SM</h5>
                      </td>
                      @elseif($ds->status == 'Proses TTD SM')
                      <td>
                        <h5 class="badge badge-light-info">Diproses SM</h5>
                      </td>
                      @elseif($ds->status == 'Done TTD SM')
                      <td>
                        <h5 class="badge badge-light-warning">Selesai TTD SM</h5>
                      </td>
                      @elseif($ds->status == 'Return to SLG')
                      <td>
                        <h5 class="badge badge-light-secondary">Dikembalikan ke Staff SLG</h5>
                      </td>
                      @elseif($ds->status == 'Pickup by Mitra')
                      <td>
                        <h5 class="badge badge-light-success">Dokumen Telah Diambil Mitra</h5>
                      </td>
                      @elseif($ds->status == 'Return to Mitra')
                      <td><h5 class="badge badge-light-success">Dokumen Selesai Diproses</h5></td>
                      @endif
                      <td>
                        <strong>Antar : </strong> {{$ds->pic_before}}</br>
                        <strong>Ambil : </strong> {{$ds->pic_after}}
                      </td>
                      <td>{{$ds->received}}</td>
                      <td>
                        <strong>Antar : </strong> {{date('d F Y', strtotime($ds->created_at))}}</br>
                        @if($ds->status == 'Pickup by Mitra')
                        <strong>Ambil : </strong> {{date('d F Y', strtotime($ds->updated_at))}}
                        @else
                        <strong>Ambil : </strong> -
                        @endif
                      </td>
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#default-{{$ds->id}}">
                            Evidence
                          </button>
                        </div>
                        <div class="modal fade text-left" id="default-{{$ds->id}}" tabindex="-1" role="dialog"
                          aria-labelledby="myModalLabel1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Evidence Dokumen</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal"
                                  aria-label="Close">
                                  <i class="bx bx-x"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5><strong>Foto Evidence Submit</strong></h5>
                                <img src="{{asset('storage/evidence/'.$ds->path_before)}}" alt="">
                                <br><br>
                                @if($ds->path_after != NULL)
                                <h5><strong>Foto Evidence Pickup</strong></h5>
                                <img src="{{asset('storage/evidence/'.$ds->path_after)}}" alt="">
                                @endif
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                  <i class="bx bx-x d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Close</span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        @if(Auth::user()->role != 2)
                        <div class="btn-group mr-1 mb-1">
                          <div class="dropdown">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Update Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{route('update-received', $ds->id)}}">Diterima Staff SLG</a>
                              <a class="dropdown-item" href="{{route('update-proses_manager', $ds->id)}}">Proses Manager</a>
                              <a class="dropdown-item" href="{{route('update-done_ttd_manager', $ds->id)}}">Selesai TTD Manager</a>
                              <a class="dropdown-item" href="{{route('update-done_paraf_manager', $ds->id)}}">Selesai Paraf Manager</a>
                              <a class="dropdown-item" href="{{route('update-received_sm', $ds->id)}}">Diterima Staff SM</a>
                              <a class="dropdown-item" href="{{route('update-proses_sm', $ds->id)}}">Proses SM</a>
                              <a class="dropdown-item" href="{{route('update-done_sm', $ds->id)}}">Selesai TTD SM</a>
                            </div>
                          </div>
                        </div>
                        @endif
                      </td>
                    </tr>
                    {{-- @endforeach --}}
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="daftar-bak" role="tabpanel" aria-labelledby="profile-tab-justified">
              <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                  <thead>
                    <tr>
                      <th>Mitra</th>
                      <th>Dokumen</th>
                      <th>Status</th>
                      <th>PIC</th>
                      <th>Diterima</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data_bak as $ds)
                    <tr>
                      <td>{{$ds->partner_name}}</td>
                      <td>
                        <strong>Dokumen : </strong>{{$ds->jenis_dokumen}}</br>
                        <strong>No KL : </strong> {{$ds->item_desc}}
                      </td>
                      @if($ds->status == 'Submitted')
                      <td>
                        <h5 class="badge badge-light-primary">Submitted</h5>
                      </td>
                      @elseif($ds->status == 'Received by SLG')
                      <td>
                        <h5 class="badge badge-light-info">Diterima Staff SLG</h5>
                      </td>
                      @elseif($ds->status == 'Proses Manager')
                      <td>
                        <h5 class="badge badge-light-info">Diproses Manager</h5>
                      </td>
                      @elseif($ds->status == 'Done TTD Manager')
                      <td>
                        <h5 class="badge badge-light-warning">Selesai TTD Manager</h5>
                      </td>
                      @elseif($ds->status == 'Done Paraf Manager')
                      <td>
                        <h5 class="badge badge-light-secondary">Selesai Paraf Manager</h5>
                      </td>
                      @elseif($ds->status == 'Received by SM Staff')
                      <td>
                        <h5 class="badge badge-light-primary">Diterima Staff SM</h5>
                      </td>
                      @elseif($ds->status == 'Proses TTD SM')
                      <td>
                        <h5 class="badge badge-light-info">Diproses SM</h5>
                      </td>
                      @elseif($ds->status == 'Done TTD SM')
                      <td>
                        <h5 class="badge badge-light-warning">Selesai TTD SM</h5>
                      </td>
                      @elseif($ds->status == 'Return to SLG')
                      <td>
                        <h5 class="badge badge-light-secondary">Dikembalikan ke Staff SLG</h5>
                      </td>
                      @elseif($ds->status == 'Pickup by Mitra')
                      <td>
                        <h5 class="badge badge-light-success">Dokumen Telah Diambil Mitra</h5>
                      </td>
                      @elseif($ds->status == 'Return to Mitra')
                      <td><h5 class="badge badge-light-success">Dokumen Selesai Diproses</h5></td>
                      @endif
                      <td>
                        <strong>Antar : </strong> {{$ds->pic_before}}</br>
                        <strong>Ambil : </strong> {{$ds->pic_after}}
                      </td>
                      <td>{{$ds->received}}</td>
                      <td>
                        <strong>Antar : </strong> {{date('d F Y', strtotime($ds->created_at))}}</br>
                        @if($ds->status == 'Pickup by Mitra')
                        <strong>Ambil : </strong> {{date('d F Y', strtotime($ds->updated_at))}}
                        @else
                        <strong>Ambil : </strong> -
                        @endif
                      </td>
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#default-{{$ds->id}}">
                            Evidence
                          </button>
                        </div>
                        <div class="modal fade text-left" id="default-{{$ds->id}}" tabindex="-1" role="dialog"
                          aria-labelledby="myModalLabel1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Evidence Dokumen</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal"
                                  aria-label="Close">
                                  <i class="bx bx-x"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5><strong>Foto Evidence Submit</strong></h5>
                                <img src="{{asset('storage/evidence/'.$ds->path_before)}}" alt="">
                                <br><br>
                                @if($ds->path_after != NULL)
                                <h5><strong>Foto Evidence Pickup</strong></h5>
                                <img src="{{asset('storage/evidence/'.$ds->path_after)}}" alt="">
                                @endif
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                  <i class="bx bx-x d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Close</span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        @if(Auth::user()->role != 2)
                        <div class="btn-group mr-1 mb-1">
                          <div class="dropdown">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Update Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{route('update-received', $ds->id)}}">Diterima Staff SLG</a>
                              <a class="dropdown-item" href="{{route('update-proses_manager', $ds->id)}}">Proses Manager</a>
                              <a class="dropdown-item" href="{{route('update-done_ttd_manager', $ds->id)}}">Selesai TTD Manager</a>
                              <a class="dropdown-item" href="{{route('update-done_paraf_manager', $ds->id)}}">Selesai Paraf Manager</a>
                              <a class="dropdown-item" href="{{route('update-received_sm', $ds->id)}}">Diterima Staff SM</a>
                              <a class="dropdown-item" href="{{route('update-proses_sm', $ds->id)}}">Proses SM</a>
                              <a class="dropdown-item" href="{{route('update-done_sm', $ds->id)}}">Selesai TTD SM</a>
                            </div>
                          </div>
                        </div>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="daftar-bapla" role="tabpanel" aria-labelledby="messages-tab-justified">
              <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                  <thead>
                    <tr>
                      <th>Mitra</th>
                      <th>Dokumen</th>
                      <th>Status</th>
                      <th>PIC</th>
                      <th>Diterima</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data_bapla as $ds)
                    {{-- @foreach($data as $ds) --}}
                    <tr>
                      <td>{{$ds->partner_name}}</td>
                      <td>
                        <strong>Dokumen : </strong>{{$ds->jenis_dokumen}}</br>
                        <strong>No KL Lama : </strong> {{$ds->item_desc}} </br>
                        <strong>No KL Perpanjangan : </strong> {{$ds->item_desc1}} </br>
                        @if($ds->sign_by == '10')
                        <strong>Penandatangan : </strong>OSM
                        @else
                        <strong>Penandatangan : </strong>Manager
                        @endif
                      </td>
                      @if($ds->status == 'Submitted')
                      <td>
                        <h5 class="badge badge-light-primary">Submitted</h5>
                      </td>
                      @elseif($ds->status == 'Received by SLG')
                      <td>
                        <h5 class="badge badge-light-info">Diterima Staff SLG</h5>
                      </td>
                      @elseif($ds->status == 'Proses Manager')
                      <td>
                        <h5 class="badge badge-light-info">Diproses Manager</h5>
                      </td>
                      @elseif($ds->status == 'Done TTD Manager')
                      <td>
                        <h5 class="badge badge-light-warning">Selesai TTD Manager</h5>
                      </td>
                      @elseif($ds->status == 'Done Paraf Manager')
                      <td>
                        <h5 class="badge badge-light-secondary">Selesai Paraf Manager</h5>
                      </td>
                      @elseif($ds->status == 'Received by SM Staff')
                      <td>
                        <h5 class="badge badge-light-primary">Diterima Staff SM</h5>
                      </td>
                      @elseif($ds->status == 'Proses TTD SM')
                      <td>
                        <h5 class="badge badge-light-info">Diproses SM</h5>
                      </td>
                      @elseif($ds->status == 'Done TTD SM')
                      <td>
                        <h5 class="badge badge-light-warning">Selesai TTD SM</h5>
                      </td>
                      @elseif($ds->status == 'Return to SLG')
                      <td>
                        <h5 class="badge badge-light-secondary">Dikembalikan ke Staff SLG</h5>
                      </td>
                      @elseif($ds->status == 'Pickup by Mitra')
                      <td>
                        <h5 class="badge badge-light-success">Dokumen Telah Diambil Mitra</h5>
                      </td>
                      @elseif($ds->status == 'Return to Mitra')
                      <td><h5 class="badge badge-light-success">Dokumen Selesai Diproses</h5></td>
                      @endif
                      <td>
                        <strong>Antar : </strong> {{$ds->pic_before}}</br>
                        <strong>Ambil : </strong> {{$ds->pic_after}}
                      </td>
                      <td>{{$ds->received}}</td>
                      <td>
                        <strong>Antar : </strong> {{date('d F Y', strtotime($ds->created_at))}}</br>
                        @if($ds->status == 'Pickup by Mitra')
                        <strong>Ambil : </strong> {{date('d F Y', strtotime($ds->updated_at))}}
                        @else
                        <strong>Ambil : </strong> -
                        @endif
                      </td>
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#default-{{$ds->id}}">
                            Evidence
                          </button>
                        </div>
                        <div class="modal fade text-left" id="default-{{$ds->id}}" tabindex="-1" role="dialog"
                          aria-labelledby="myModalLabel1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Evidence Dokumen</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal"
                                  aria-label="Close">
                                  <i class="bx bx-x"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5><strong>Foto Evidence Submit</strong></h5>
                                <img src="{{asset('storage/evidence/'.$ds->path_before)}}" alt="">
                                <br><br>
                                @if($ds->path_after != NULL)
                                <h5><strong>Foto Evidence Pickup</strong></h5>
                                <img src="{{asset('storage/evidence/'.$ds->path_after)}}" alt="">
                                @endif
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                  <i class="bx bx-x d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Close</span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        @if(Auth::user()->role != 2)
                        <div class="btn-group mr-1 mb-1">
                          <div class="dropdown">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Update Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{route('update-received', $ds->id)}}">Diterima Staff SLG</a>
                              <a class="dropdown-item" href="{{route('update-proses_manager', $ds->id)}}">Proses Manager</a>
                              <a class="dropdown-item" href="{{route('update-done_ttd_manager', $ds->id)}}">Selesai TTD Manager</a>
                              <a class="dropdown-item" href="{{route('update-done_paraf_manager', $ds->id)}}">Selesai Paraf Manager</a>
                              <a class="dropdown-item" href="{{route('update-received_sm', $ds->id)}}">Diterima Staff SM</a>
                              <a class="dropdown-item" href="{{route('update-proses_sm', $ds->id)}}">Proses SM</a>
                              <a class="dropdown-item" href="{{route('update-done_sm', $ds->id)}}">Selesai TTD SM</a>
                            </div>
                          </div>
                        </div>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                    {{-- @endforeach --}}
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="daftar-lainnya" role="tabpanel" aria-labelledby="settings-tab-justified">
              <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                  <thead>
                    <tr>
                      <th>Mitra</th>
                      <th>Dokumen</th>
                      <th>Status</th>
                      <th>PIC</th>
                      <th>Diterima</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data_lainnya as $ds)
                    <tr>
                      <td>{{$ds->partner_name}}</td>
                      <td>
                        <strong>Dokumen : </strong>{{$ds->jenis_dokumen}}</br>
                        <strong>No KL : </strong> {{$ds->item_desc}}
                      </td>
                      @if($ds->status == 'Submitted')
                      <td>
                        <h5 class="badge badge-light-primary">Submitted</h5>
                      </td>
                      @elseif($ds->status == 'Received by SLG')
                      <td>
                        <h5 class="badge badge-light-info">Diterima Staff SLG</h5>
                      </td>
                      @elseif($ds->status == 'Proses Manager')
                      <td>
                        <h5 class="badge badge-light-info">Diproses Manager</h5>
                      </td>
                      @elseif($ds->status == 'Done TTD Manager')
                      <td>
                        <h5 class="badge badge-light-warning">Selesai TTD Manager</h5>
                      </td>
                      @elseif($ds->status == 'Done Paraf Manager')
                      <td>
                        <h5 class="badge badge-light-secondary">Selesai Paraf Manager</h5>
                      </td>
                      @elseif($ds->status == 'Received by SM Staff')
                      <td>
                        <h5 class="badge badge-light-primary">Diterima Staff SM</h5>
                      </td>
                      @elseif($ds->status == 'Proses TTD SM')
                      <td>
                        <h5 class="badge badge-light-info">Diproses SM</h5>
                      </td>
                      @elseif($ds->status == 'Done TTD SM')
                      <td>
                        <h5 class="badge badge-light-warning">Selesai TTD SM</h5>
                      </td>
                      @elseif($ds->status == 'Return to SLG')
                      <td>
                        <h5 class="badge badge-light-secondary">Dikembalikan ke Staff SLG</h5>
                      </td>
                      @elseif($ds->status == 'Pickup by Mitra')
                      <td>
                        <h5 class="badge badge-light-success">Dokumen Telah Diambil Mitra</h5>
                      </td>
                      @elseif($ds->status == 'Return to Mitra')
                      <td><h5 class="badge badge-light-success">Dokumen Selesai Diproses</h5></td>
                      @endif
                      <td>
                        <strong>Antar : </strong> {{$ds->pic_before}}</br>
                        <strong>Ambil : </strong> {{$ds->pic_after}}
                      </td>
                      <td>{{$ds->received}}</td>
                      <td>
                        <strong>Antar : </strong> {{date('d F Y', strtotime($ds->created_at))}}</br>
                        @if($ds->status == 'Pickup by Mitra')
                        <strong>Ambil : </strong> {{date('d F Y', strtotime($ds->updated_at))}}
                        @else
                        <strong>Ambil : </strong> -
                        @endif
                      </td>
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#default-{{$ds->id}}">
                            Evidence
                          </button>
                        </div>
                        <div class="modal fade text-left" id="default-{{$ds->id}}" tabindex="-1" role="dialog"
                          aria-labelledby="myModalLabel1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Evidence Dokumen</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal"
                                  aria-label="Close">
                                  <i class="bx bx-x"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5><strong>Foto Evidence Submit</strong></h5>
                                <img src="{{asset('storage/evidence/'.$ds->path_before)}}" alt="">
                                <br><br>
                                @if($ds->path_after != NULL)
                                <h5><strong>Foto Evidence Pickup</strong></h5>
                                <img src="{{asset('storage/evidence/'.$ds->path_after)}}" alt="">
                                @endif
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                  <i class="bx bx-x d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Close</span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="btn-group mr-1 mb-1">
                          <div class="dropdown">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Update Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{route('update-received', $ds->id)}}">Diterima Staff SLG</a>
                              <a class="dropdown-item" href="{{route('update-proses_manager', $ds->id)}}">Proses Manager</a>
                              <a class="dropdown-item" href="{{route('update-done_ttd_manager', $ds->id)}}">Selesai TTD Manager</a>
                              <a class="dropdown-item" href="{{route('update-done_paraf_manager', $ds->id)}}">Selesai Paraf Manager</a>
                              <a class="dropdown-item" href="{{route('update-received_sm', $ds->id)}}">Diterima Staff SM</a>
                              <a class="dropdown-item" href="{{route('update-proses_sm', $ds->id)}}">Proses SM</a>
                              <a class="dropdown-item" href="{{route('update-done_sm', $ds->id)}}">Selesai TTD SM</a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
@endsection

{{--page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/navs/navs.js')}}"></script>
<script src="{{asset('js/scripts/datatables/datatable.js')}}"></script>
<script src="{{asset('js/scripts/modal/components-modal.js')}}"></script>
<script src="{{asset('js/scripts/pages/bootstrap-toast.js')}}"></script>
@endsection
