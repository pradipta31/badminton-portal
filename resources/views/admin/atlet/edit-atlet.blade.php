@extends('admin.layouts.master',['activeMenu' => 'atlet'])
@section('title','Edit Atlet')

@section('content')
  <section class="content-header">
    <h1>
      Atlet
      <small>Edit Atlet</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Edit Atlet</li>
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
    <form class="" action="{{url('admin/atlet/'.$atlet->id.'/edit-atlet')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="put">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Atlet</h3>
            </div>
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Klub</label>
                  <select class="form-control" name="id_klub">
                    <option value="0">-- Pilih Klub --</option>
                    @foreach($clubs as $club)
                      <option value="{{$club->id}}" {{$club->id == $atlet->id_klub ? 'selected' : ''}}>{{$club->nama_klub}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Kode Atlet</label>
                  <input type="text" class="form-control" placeholder="Kode Atlet" name="kode_atlet" value="{{$atlet->kode_atlet}}">
                </div>
                <div class="form-group">
                  <label>Nama Atlet</label>
                  <input type="text" class="form-control" placeholder="Nama Atlet" name="nama" value="{{$atlet->nama}}">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" value="{{$atlet->tempat_lahir}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tgl_lahir" value="{{$atlet->tgl_lahir}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Foto Atlet</label>
                  <input type="file" class="form-control" name="foto">
                  <small>Note: Kosongkan jika tidak ada foto atlet</small>
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
