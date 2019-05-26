@extends('frontend.layouts.app')
@section('css')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
@section('title','Detail Kejuaraan')
@section('content')
<style media="screen">
  #header{
    margin-top: 0;
  }

  #imgbox img{
    margin-top: 100px;
  }
</style>
<div class="row-fluid">
  <div class="span9">
    <div class="widget-box">
      <div class="widget-title"><span class="icon"><i class="icon-file"></i></span>
        <h5>{{$kejuaraans->nama_kejuaraan}}</h5>
      </div>
      <div class="widget-content nopadding">
        <ul class="recent-posts">
          <div class="card mb-3" style="margin-top: 10px; margin-left: 5px; margin-right: 5px">
            <div class="row no-gutters">
              <h2 class="card-title">
                <span style="margin-left: 5px">{{$kejuaraans->nama_kejuaraan}}</span>
              </h2>
              <div class="col-md-12">
                <div class="card-body">
                  <table class="table table-sm">
                    <tr>
                      <td class="table-light" width="150px">Tanggal</td>
                      <td class="table-active">
                        @if($kejuaraans->tgl_mulai == null)
                          {{date('d-m-Y',strtotime($kejuaraans->tgl_akhir))}}
                        @else
                          {{date('d-m-Y',strtotime($kejuaraans->tgl_mulai))}} - {{date('d-m-Y',strtotime($kejuaraans->tgl_akhir))}}
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td class="table-light" width="150px">Kategori</td>
                      <td class="table-active">{{$kejuaraans->kategori}}</td>
                    </tr>

                    <tr>
                      <td class="table-light" width="150px">Kota</td>
                      <td class="table-active">{{$kejuaraans->kabupaten}}</td>
                    </tr>

                    <tr>
                      <td class="table-light" width="150px">Batas Pendaftaran</td>
                      <td class="table-active">
                        @if($kejuaraans->batas_pendaftaran == null)
                          -
                        @else
                          {{date('d-m-Y', strtotime($kejuaraans->batas_pendaftaran))}}
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td class="table-light" width="150px">Hadiah</td>
                      <td class="table-active">
                        @if($kejuaraans->hadiah == null)
                          -
                        @else
                          {{$kejuaraans->hadiah}}
                        @endif
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </ul>
      </div>
    </div>

    <div class="widget-box">
      <div class="widget-title"><span class="icon"><i class="icon-file"></i></span>
        <h5>Informasi Turnamen</h5>
      </div>
      <div class="widget-content nopadding">
        <ul class="recent-posts">
          <div class="card mb-3" style="margin-top: 10px; margin-left: 5px; margin-right: 5px">
            <div class="row no-gutters">
              <div class="col-md-12">
                @if($kejuaraans->status_berkas == 'belum')
                  <div class="card-body">
                    <h2>[Belum ada Informasi Kejuaraan]</h2>
                  </div>
                @else
                  <div class="card-body">
                    <h2>Informasi Kejuaraan</h2>
                    <p>
                      <b>[Ketentuan Kejuaraan]</b>
                      <br>
                      " Untuk informasi Kejuaraan silahkan download disini"
                      <br>
                      <br>
                      <br>
                      <a href="{{ route('ketentuan.download', $kejuaraan->ketentuan) }}">Download File</a>
                    </p>
                    <hr>
                    <h2>Tatacara Pendaftaran</h2>
                    <p>
                      <b>[Pendaftaran]</b>
                      <br>
                      " Untuk informasi Tatacara Pendaftaran silahkan download disini"
                      <br>
                      <br>
                      <br>
                      <a href="{{ route('tatacara.download', $kejuaraan->tatacara) }}">Download File</a>
                    </p>
                    <hr>
                    @if($kejuaraan->hasil == null)
                      <h2>[Belum ada Informasi Hasil Kejuaraan]</h2>
                    @else
                    <h2>Hasil Kejuaraan</h2>
                    <p>
                      <b>[Hasil Kejuaraan]</b>
                      <br>
                      " Untuk informasi Hasil kejuaraan silahkan download disini"
                      <br>
                      <br>
                      <br>
                      <a href="{{ route('hasil.download', $kejuaraan->hasil_kejuaraan) }}">Download File</a>
                    </p>
                    @endif
                  </div>
                @endif
              </div>
            </div>
          </div>
        </ul>
      </div>
    </div>
  </div>
  @include('frontend.berita.berita')

</div>

@endsection
