@extends('admin.layouts.master',['activeMenu' => 'gallery'])
@section('title','Tambah Gallery')

@section('content')
  <section class="content-header">
    <h1>
      Gallery
      <small>Tambah Gallery</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Tambah Gallery</li>
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
    <form class="" action="{{url('admin/gallery/tambah-gallery')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Gallery Baru</h3>
            </div>
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Judul Gallery</label>
                  <input type="text" class="form-control" placeholder="Judul Gallery" name="judul">
                </div>
                <div class="form-group">
                  <label>Cover Gambar</label>
                  <input type="file" name="gambar" class="form-control">
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea name="deskripsi" rows="8" cols="80" class="form-control"></textarea>
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
