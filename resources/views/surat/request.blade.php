@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Form Nomor Surat')

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
          <h4 class="card-title">Request Nomor Surat</h4>
        </div>
        <div class="card-body">
          <p>

          </p>
          <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#req-bapla" role="tab"
                aria-controls="daftar-bapl" aria-selected="true">
                BAPLA
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#req-lainnya" role="tab"
                aria-controls="daftar-bak" aria-selected="true">
                Lainnya
              </a>
            </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content pt-1">
            <div class="tab-pane active" id="req-bapla" role="tabpanel" aria-labelledby="profile-tab-justified">
              <section id="basic-vertical-layouts">
                <div class="row match-height">
                  <div class="col-md-12 col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Request Nomor BAPLA</h4>
                      </div>
                      <div class="card-body">
                        <form action="{{route('store-bapla')}}" method="POST" class="form form-vertical">
                        {{ csrf_field() }}
                          <div class="form-body">
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="contact-info-vertical">No KL</label>
                                  <input class="form-control" list="listKl_bak" id="exampleDataList" name="item_desc"
                                    placeholder="Type to search...">
                                  <datalist id="listKl_bak">
                                    @foreach($m_kl as $kl)
                                    <option value="{{$kl->no_kl}}">{{$kl->no_kl}}</option>
                                    @endforeach
                                  </datalist>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="password-vertical">Penandatangan</label>
                                  <select class="form-control" id="basicSelect" name="sign_by">
                                    <option selected disabled>Pilih Penandatangan</option>
                                    <option value="10">OSM</option>
                                    <option value="20">Manager</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mr-1">Submit</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <div class="tab-pane" id="req-lainnya" role="tabpanel" aria-labelledby="settings-tab-justified">
                <section id="basic-vertical-layouts">
                    <div class="row match-height">
                      <div class="col-md-12 col-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title">Request Nomor Surat</h4>
                          </div>
                          <div class="card-body">
                            <form action="{{route('store-lainnya')}}" method="POST" class="form form-vertical">
                            {{ csrf_field() }}
                              <div class="form-body">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="form-group">
                                      <label for="contact-info-vertical">Keterangan</label>
                                      <input type="text" class="form-control" name="item_desc"
                                        placeholder="Masukkan Keterangan (ex: Nota Dinas ABCD)...">
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                      <label for="password-vertical">Penandatangan</label>
                                      <select class="form-control" id="basicSelect" name="sign_by">
                                        <option selected disabled>Pilih Penandatangan</option>
                                        <option value="10">OSM</option>
                                        <option value="20">Manager</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- webcamjs  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
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
@endsection
