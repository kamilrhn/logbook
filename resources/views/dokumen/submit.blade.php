@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Submit Dokumen')

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
          <h4 class="card-title">Submit Dokumen</h4>
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
                aria-controls="daftar-bapla" aria-selected="true">
                BAPLA
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#daftar-lainnya" role="tab"
                aria-controls="daftar-lainnya" aria-selected="true">
                Lainnya
              </a>
            </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content pt-1">
            <div class="tab-pane active" id="daftar-bapl" role="tabpanel" aria-labelledby="home-tab-justified">
              <section id="basic-vertical-layouts">
                <div class="row match-height">
                  <div class="col-md-12 col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Submit Dokumen BAPL</h4>
                      </div>
                      <div class="card-body">
                        <form class="form form-vertical" action="{{route('store-dok')}}" method="POST">
                          {{csrf_field()}}
                          <div class="form-body">
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="first-name-vertical">Nama Mitra</label>
                                  @if (Auth::user()->role == 2)
                                  <input type="text" name="partner_name" class="form-control phone-mask"
                                    value="{{Auth::user()->partner->partner_name}}" disabled required />
                                  <input type="text" name="partner_name" class="form-control phone-mask"
                                    value="{{Auth::user()->partner->partner_name}}" hidden required />
                                  @else
                                  <input class="form-control" list="listMitra" id="exampleDataList" name="partner_name"
                                    placeholder="Type to search...">
                                  <datalist id="listMitra">
                                    @foreach($partner as $p)
                                    <option value="{{$p->partner_name}}">{{$p->partner_name}}</option>
                                    @endforeach
                                  </datalist>
                                  @endif
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="email-id-vertical">Jenis Dokumen</label>
                                  <input class="form-control" list="listDokumen" id="exampleDataList"
                                    name="jenis_dokumen" value="BAPL" disabled required>
                                  <input class="form-control" list="listDokumen" id="exampleDataList"
                                    name="jenis_dokumen" value="BAPL" hidden required>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="contact-info-vertical">No Penagihan</label>
                                  <input class="form-control" list="listKl_bapl" id="exampleDataList" name="item_desc"
                                    placeholder="Type to search...">
                                  <datalist id="listKl_bapl">
                                    @foreach($no_penagihan as $rng)
                                    <option value="{{$rng->NO_PENAGIHAN}}">{{$rng->NO_KL}} - {{$rng->PERIODE_DESC}}
                                    </option>
                                    @endforeach
                                  </datalist>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="password-vertical">Nama PIC Antar</label>
                                  <input type="text" name="partner_pic" class="form-control phone-mask"
                                    placeholder="Nama PIC Mitra" required />
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="password-vertical">Evidence Antar</label>
                                  <div id="my_camera"></div>
                                  <br>
                                  <div id="results">Foto Evidence Akan Muncul Disini...</div>
                                </div>
                                <div class="form-group">
                                  <input type=button class="btn btn-info" value="Ambil Foto" onClick="take_snapshot1()">
                                  <input type="hidden" name="image" class="image-tag" required>
                                  <br>
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
            <div class="tab-pane" id="daftar-bak" role="tabpanel" aria-labelledby="profile-tab-justified">
              <section id="basic-vertical-layouts">
                <div class="row match-height">
                  <div class="col-md-12 col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Submit Dokumen BA Kronologis</h4>
                        <a data-toggle="modal"  data-target="#add_kl" class="btn btn-md btn-info"><strong>Tambah KL</strong></a>
                        <div class="modal fade" id="add_kl" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel1">TAMBAH NO KL</h5>
                                      <button type="button" class="close rounded-pill" data-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bx bx-x"></i>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                     <form action="{{route('store-kl')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="mb-3">
                                          <label class="form-label" for="basic-default-phone">No KL</label>
                                          <input type="text" name="no_kl" class="form-control phone-mask" placeholder="Input Nomor KL" style="text-transform: uppercase;"
                                            required />
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Save</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <form class="form form-vertical" action="{{route('store-dok')}}" method="POST">
                          {{csrf_field()}}
                          <div class="form-body">
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="first-name-vertical">Nama Mitra</label>
                                  @if (Auth::user()->role == 2)
                                  <input type="text" name="partner_name" class="form-control phone-mask"
                                    value="{{Auth::user()->partner->partner_name}}" disabled required />
                                  <input type="text" name="partner_name" class="form-control phone-mask"
                                    value="{{Auth::user()->partner->partner_name}}" hidden required />
                                  @else
                                  <input class="form-control" list="listMitra" id="exampleDataList" name="partner_name"
                                    placeholder="Type to search...">
                                  <datalist id="listMitra">
                                    @foreach($partner as $p)
                                    <option value="{{$p->partner_name}}">{{$p->partner_name}}</option>
                                    @endforeach
                                  </datalist>
                                  @endif
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="email-id-vertical">Jenis Dokumen</label>
                                  <input class="form-control" list="listDokumen" id="exampleDataList" name="jenis_dokumen"
                                  value="BA Kronologis" disabled required>
                                  <input class="form-control" list="listDokumen" id="exampleDataList" name="jenis_dokumen"
                                  value="BA Kronologis" hidden required>
                                </div>
                              </div>
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
                                  <label for="password-vertical">Nama PIC Antar</label>
                                  <input type="text" name="partner_pic" class="form-control phone-mask"
                                    placeholder="Nama PIC Mitra" required />
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="password-vertical">Evidence Antar</label>
                                  <div id="my_camera1"></div>
                                  <br>
                                  <div id="results1">Foto Evidence Akan Muncul Disini...</div>
                                </div>
                                <div class="form-group">
                                  <input type=button class="btn btn-info" value="Ambil Foto" onClick="take_snapshot2()">
                                  <input type="hidden" name="image" class="image-tag1" required>
                                  <br>
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
            <div class="tab-pane" id="daftar-bapla" role="tabpanel" aria-labelledby="messages-tab-justified">
              <section id="basic-vertical-layouts">
                <div class="row match-height">
                  <div class="col-md-12 col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Submit Dokumen BAPLA</h4>
                      </div>
                      <div class="card-body">
                        <form class="form form-vertical" action="{{route('store-dok')}}" method="POST">
                          {{csrf_field()}}
                          <div class="form-body">
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="first-name-vertical">Nama Mitra</label>
                                  @if (Auth::user()->role == 2)
                                  <input type="text" name="partner_name" class="form-control phone-mask"
                                    value="{{Auth::user()->partner->partner_name}}" disabled required />
                                  <input type="text" name="partner_name" class="form-control phone-mask"
                                    value="{{Auth::user()->partner->partner_name}}" hidden required />
                                  @else
                                  <input class="form-control" list="listMitra" id="exampleDataList" name="partner_name"
                                    placeholder="Type to search...">
                                  <datalist id="listMitra">
                                    @foreach($partner as $p)
                                    <option value="{{$p->partner_name}}">{{$p->partner_name}}</option>
                                    @endforeach
                                  </datalist>
                                  @endif
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="email-id-vertical">Jenis Dokumen</label>
                                  <input class="form-control" list="listDokumen" id="exampleDataList"
                                    name="jenis_dokumen" value="BAPLA" disabled required>
                                  <input class="form-control" list="listDokumen" id="exampleDataList"
                                    name="jenis_dokumen" value="BAPLA" hidden required>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="contact-info-vertical">No KL Sebelumnya</label>
                                  <input class="form-control" list="listKl_bak1" id="exampleDataList" name="item_desc"
                                    placeholder="Type to search...">
                                  <datalist id="listKl_bak1">
                                    @foreach($m_kl as $kl)
                                    <option value="{{$kl->no_kl}}">{{$kl->no_kl}}</option>
                                    @endforeach
                                  </datalist>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label class="form-label" for="basic-default-phone">No KL Perpanjangan</label>
                                  <input type="text" name="item_desc1" class="form-control phone-mask" placeholder="Input Nomor KL Perpanjangan Dengan Lengkap" style="text-transform: uppercase;"
                                    required />
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
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="password-vertical">Nama PIC Antar</label>
                                  <input type="text" name="partner_pic" class="form-control phone-mask"
                                    placeholder="Nama PIC Mitra" required />
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="password-vertical">Evidence Antar</label>
                                  <div id="my_camera2"></div>
                                  <br>
                                  <div id="results2">Foto Evidence Akan Muncul Disini...</div>
                                </div>
                                <div class="form-group">
                                  <input type=button class="btn btn-info" value="Ambil Foto" onClick="take_snapshot3()">
                                  <input type="hidden" name="image" class="image-tag2" required>
                                  <br>
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
            <div class="tab-pane" id="daftar-lainnya" role="tabpanel" aria-labelledby="settings-tab-justified">
              <p>
                Biscuit powder jelly beans. Lollipop candy canes croissant icing chocolate cake. Cake fruitcake powder
                pudding pastry.I love caramels caramels halvah chocolate bar. Cotton candy
                gummi bears pudding pie apple pie cookie.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- webcamjs  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
<script language="JavaScript">
  // menampilkan kamera dengan menentukan ukuran, format dan kualitas 
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90
  });

  //menampilkan webcam di dalam file html dengan id my_camera
  Webcam.attach('#my_camera');

  function take_snapshot1() {
    Webcam.snap(function (data_uri) {
      $(".image-tag").val(data_uri);
      document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
    });
  }

</script>
<script language="JavaScript">
    // menampilkan kamera dengan menentukan ukuran, format dan kualitas 
    Webcam.set({
      width: 320,
      height: 240,
      image_format: 'jpeg',
      jpeg_quality: 90
    });
  
    //menampilkan webcam di dalam file html dengan id my_camera
    Webcam.attach('#my_camera1');
  
    function take_snapshot2() {
      Webcam.snap(function (data_uri) {
        $(".image-tag1").val(data_uri);
        document.getElementById('results1').innerHTML = '<img src="' + data_uri + '"/>';
      });
    }
  
</script>
<script language="JavaScript">
    // menampilkan kamera dengan menentukan ukuran, format dan kualitas 
    Webcam.set({
      width: 320,
      height: 240,
      image_format: 'jpeg',
      jpeg_quality: 90
    });
  
    //menampilkan webcam di dalam file html dengan id my_camera
    Webcam.attach('#my_camera2');
  
    function take_snapshot3() {
      Webcam.snap(function (data_uri) {
        $(".image-tag2").val(data_uri);
        document.getElementById('results2').innerHTML = '<img src="' + data_uri + '"/>';
      });
    }
  
</script>
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
