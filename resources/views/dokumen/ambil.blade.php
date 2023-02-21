@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Ambil Dokumen')

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
          <h4 class="card-title">Ambil Dokumen</h4>
        </div>
        <div class="card-body">
          <p>

          </p>
          <!-- Tab panes -->
          <div class="tab-content pt-1">
            <div class="tab-pane active" id="daftar-bapl" role="tabpanel" aria-labelledby="home-tab-justified">
              <section id="basic-vertical-layouts">
                <div class="row match-height">
                  <div class="col-md-12 col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Ambil Dokumen {{$data->jenis_dokumen}} {{$data->item_desc}}</h4>
                      </div>
                      <div class="card-body">
                        <form class="form form-vertical" action="{{route('store-ambil', $data->id)}}" method="POST">
                          {{csrf_field()}}
                          <div class="form-body">
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="password-vertical">Nama PIC Ambil</label>
                                  <input type="text" name="partner_pic" class="form-control phone-mask"
                                    placeholder="Nama PIC Mitra" required />
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="password-vertical">Evidence Ambil</label>
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
