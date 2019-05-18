@extends('admin.layouts.master',['activeMenu' => 'kejuaraan'])
@section('title','Tambah Kejuaraan')

@section('content')
  <section class="content-header">
    <h1>
      Berkas Kejuaraan
      <small>Berkas Kejuaraan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Berkas Kejuaraan</li>
    </ol>
  </section>
  <section class="content">
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Informasi !</h4>
            {{Session::get('success')}}
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Informasi !</h4>
            {{Session::get('error')}}
        </div>
    @endif
    <form class="" action="{{url('admin/kejuaraan/berkas/'.$berkas->id)}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="put">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Berkas Kejuaraan : {{$berkas->kejuaraan->nama_kejuaraan}}</h3>
            </div>
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-form-label">Ketentuan Kejuaraan</label>
                  <input type="file" class="form-control" name="ketentuan">
                  <a href="{{ route('ketentuan.download', $berkas->ketentuan) }}">Download File</a>
                </div>
                <div class="form-group">
                  <label class="col-form-label">Tatacara Pendaftaran</label>
                  <input type="file" class="form-control" name="tatacara">
                  <a href="{{ route('tatacara.download', $berkas->tatacara) }}">Download File</a>
                </div>
                <div class="form-group">
                  <label class="col-form-label">Hasil Kejuaraan</label>
                  <input type="file" class="form-control" name="hasil_kejuaraan">
                  @if($berkas->hasil_kejuaraan == null)
                    <span class="label label-warning">Hasil kejuaraan belum diupload.</span>
                  @else
                    <a href="{{ route('hasil.download', $berkas->hasil_kejuaraan) }}">Download File</a>
                  @endif
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </form>
  </section>
@endsection
@section('js')
@endsection
