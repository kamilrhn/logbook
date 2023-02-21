@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Inbox Nomor Surat')

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
          <h4 class="card-title">Daftar Nomor Surat</h4>
        </div>
        <div class="card-body">
          <p>

          </p>
          <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#daftar-bapl" role="tab"
                aria-controls="daftar-bapl" aria-selected="true">
                Requested
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#daftar-bak" role="tab"
                aria-controls="daftar-bak" aria-selected="true">
                Done
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
                      <th>Jenis Surat</th>
                      <th>Penandatangan</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>Diajukan Oleh</th>
                      @if(Auth::user()->role != 2)
                      <th>Aksi</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($surat_req as $ds)
                    {{-- @foreach($data as $ds) --}}
                    <tr>
                      <td>{{$ds->jenis}}</td>
                      @if($ds->sign_by == '10')
                      <td>OSM</td>
                      @elseif($ds->sign_by == '20')
                      <td>Manager</td>
                      @endif
                      <td>{{$ds->item_desc}}</td>
                      @if($ds->status == 'Requested')
                      <td>
                        <h5 class="badge badge-light-primary">Requested</h5>
                      </td>
                      @else
                      <td>
                        <h5 class="badge badge-light-info">Nomor Surat Telah Diterbitkan</h5>
                      </td>
                      @endif
                      <td>
                       {{$ds->created_by}}
                      </td>
                      @if(Auth::user()->role != 2)
                      <td>
                        <div class="btn-group mr-1 mb-1">
                            <a href="{{route('generate-nomor', $ds->id)}}" class="btn btn-info btn-sm">
                                Terbitkan Nomor
                            </a>
                        </div>
                      </td>
                      @endif
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
                          <th>Jenis Surat</th>
                          <th>Penandatangan</th>
                          <th>Keterangan</th>
                          <th>Nomor Surat</th>
                          <th>Status</th>
                          <th>Diajukan Oleh</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($surat_done as $ds)
                        {{-- @foreach($data as $ds) --}}
                        <tr>
                          <td>{{$ds->jenis}}</td>
                          @if($ds->sign_by == '10')
                          <td>OSM</td>
                          @elseif($ds->sign_by == '20')
                          <td>Manager</td>
                          @endif
                          <td>{{$ds->item_desc}}</td>
                          @if($ds->nomor == NULL)
                          <td>N/A</td>
                          @else
                          <td>{{$ds->nomor}}</td>
                          @endif
                          @if($ds->status == 'Requested')
                          <td>
                            <h5 class="badge badge-light-primary">Requested</h5>
                          </td>
                          @else
                          <td>
                            <h5 class="badge badge-light-info">Nomor Surat Telah Diterbitkan</h5>
                          </td>
                          @endif
                          <td>{{$ds->created_by}}</td>
                        </tr>
                        {{-- @endforeach --}}
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
