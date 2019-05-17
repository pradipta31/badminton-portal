@extends('admin.layouts.master',['activeMenu' => 'kejuaraan'])
@section('title','Tambah Kejuaraan')

@section('content')
  <section class="content-header">
    <h1>
      Kejuaraan
      <small>Tambah Kejuaraan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Tambah Kejuaraan</li>
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
    <form class="" action="{{url('admin/kejuaraan/tambah-kejuaraan')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Kejuaraan Baru</h3>
            </div>
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Nama Kejuaraan</label>
                  <input type="text" class="form-control" placeholder="Nama kejuaraan" name="nama_kejuaraan">
                </div>
                <div class="form-group">
                  <label>Kategori Kejuaraan</label>
                  <input type="text" class="form-control" placeholder="Kategori kejuaraan" name="kategori">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal Mulai</label>
                      <input type="date" class="form-control" name="tgl_mulai">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal Akhir</label>
                      <input type="date" class="form-control" name="tgl_akhir">
                    </div>
                  </div>
                  <div class="col-md-12" style="margin-top: -10px; margin-bottom: 5px">
                    <small>Note: Tanggal mulai dapat dikosongkan jika kejuaraan hanya berlangsung dalam 1 hari.</small>
                  </div>
                </div>
                <div class="form-group">
                  <label>Kabupaten</label>
                  <select class="form-control" name="kabupaten">
                    <option value="Denpasar">Kota Denpasar</option>
                    <option value="Badung">Badung</option>
                    <option value="Gianyar">Gianyar</option>
                    <option value="Tabanan">Tabanan</option>
                    <option value="Karangasem">Karangasem</option>
                    <option value="Bangli">Bangli</option>
                    <option value="Negara">Negara</option>
                    <option value="Buleleng">Buleleng</option>
                    <option value="Klungkung">Klungkung</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Hadiah</label>
                  <input type="text" class="form-control" placeholder="Hadiah" name="hadiah">
                </div>
                <div class="form-group">
                  <label>Batas Pendaftaran</label>
                  <input type="date" class="form-control" name="batas_pendaftaran">
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
