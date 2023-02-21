@extends('layouts.contentLayoutMaster')
{{-- title --}}
@if ($route == 'aktif')
@section('title','Dokumen Selesai Sirkulir')
@elseif ($route == 'bapl')
@section('title','Dokumen BAPL')
@elseif ($route == 'bak')
@section('title','Dokumen BA Kronologis')
@endif

@section('vendor-styles')
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<!-- Column selectors with Export Options and print table -->
<section id="column-selectors">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
           @if ($route == 'aktif')
           Dokumen Selesai Sirkulir
           @elseif ($route == 'bapl')
           Dokumen BAPL
           @elseif ($route == 'bak')
           Dokumen BA Kronologis
           @endif
          </h4>
        </div>
        <div class="card-body card-dashboard">
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
                    <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $ds)
                <tr>
                  <td>{{$ds->partner_name}}</td>
                  @if($ds->jenis_dokumen == 'BAPL')
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
                  @elseif($ds->jenis_dokumen == 'BA Kronologis')
                  <td>
                    <strong>Dokumen : </strong>{{$ds->jenis_dokumen}}</br>
                    <strong>No KL : </strong> {{$ds->item_desc}}
                    @if($ds->sign_by == '10')
                    <strong>Penandatangan : </strong>OSM
                    @else
                    <strong>Penandatangan : </strong>Manager
                    @endif
                  </td>
                  @elseif($ds->jenis_dokumen == 'BAPLA')
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
                  @endif
                  @if($ds->status == 'Submitted')
                  <td><h5 class="badge badge-light-primary">Submitted</h5></td>
                  @elseif($ds->status == 'Received by SLG')
                  <td><h5 class="badge badge-light-info">Diterima Staff SLG</h5></td>
                  @elseif($ds->status == 'Proses Manager')
                  <td><h5 class="badge badge-light-info">Diproses Manager</h5></td>
                  @elseif($ds->status == 'Done TTD Manager')
                  <td><h5 class="badge badge-light-warning">Selesai TTD Manager</h5></td>
                  @elseif($ds->status == 'Done Paraf Manager')
                  <td><h5 class="badge badge-light-secondary">Selesai Paraf Manager</h5></td>
                  @elseif($ds->status == 'Received by SM Staff')
                  <td><h5 class="badge badge-light-primary">Diterima Staff SM</h5></td>
                  @elseif($ds->status == 'Proses TTD SM')
                  <td><h5 class="badge badge-light-info">Diproses SM</h5></td>
                  @elseif($ds->status == 'Done TTD SM')
                  <td><h5 class="badge badge-light-warning">Selesai TTD SM</h5></td>
                  @elseif($ds->status == 'Return to SLG')
                  <td><h5 class="badge badge-light-secondary">Dikembalikan ke Staff SLG</h5></td>
                  @elseif($ds->status == 'Pickup by Mitra')
                  <td><h5 class="badge badge-light-success">Dokumen Selesai Diproses</h5></td>
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
                      <a href="{{route('ambil-dok', $ds->id)}}" type="button" class="btn btn-info btn-sm">
                        Ambil
                      </a>
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
</section>
<!-- Column selectors with Export Options and print table -->
@endsection
{{-- vendor scripts --}}
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
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/datatables/datatable.js')}}"></script>
@endsection
