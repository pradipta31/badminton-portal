@extends('admin.layouts.master',['activeMenu' => 'kategori-rangking'])
@section('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endsection
@section('title','Tambah Rangking')

@section('content')
  <section class="content-header">
    <h1>
      Rangking
      <small>Tambah Rangking</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Tambah Rangking</li>
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
    <form class="" action="{{url('admin/rangking/tambah-rangking')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Rangking Baru</h3>
            </div>
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Jenis Kategori</label>
                  <select class="form-control" name="kode_kategori" id="kode_kategori">
                    <option value="0">-- Pilih Jenis Kategori --</option>
                    <option value="1">Tunggal</option>
                    <option value="2">Ganda</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Kategori</label>
                  <select class="form-control" name="id_kategori">
                      <option value="0">-- Pilih Kategori --</option>
                    @foreach($categories as $kategori)
                      <option value="{{$kategori->id}}">{{$kategori->kategori}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group" id="atlet_tunggal">
                  <label>Pilih Atlet</label>
                  <select class="form-control select2" name="id_atlet" id="a_tunggal" style="width: 100%">
                    @foreach($atlets as $atlet)
                      <option value="{{$atlet->id}}">{{$atlet->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group" id="atlet_ganda">
                  <label>Pilih Pasangan Atlet</label>
                  <select class="form-control select2" name="id_pas_atlet" id="a_ganda" style="width: 100%">
                    @foreach($atlets as $atlet)
                      <option value="{{$atlet->id}}">{{$atlet->nama}}</option>
                    @endforeach
                  </select>
                  <span id="message" class="label label-danger"></span>
                </div>
                <div class="form-group">
                  <label>Rangking</label>
                  <input type="number" class="form-control" placeholder="Rangking" name="ranking">
                </div>
                <div class="form-group">
                  <label>Total Main</label>
                  <input type="number" class="form-control" placeholder="Total Main" name="total_main">
                </div>
                <div class="form-group">
                  <label>Total Poin</label>
                  <input type="number" class="form-control" placeholder="Total Poin" name="total_poin">
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
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  $('#kode_kategori').on('change',function(){
    var valueSelected = this.value;
    $('#atlet_ganda').hide();
    if(valueSelected == 0){
      $('#atlet_tunggal').hide();
    }else if(valueSelected == 1){
      console.log(valueSelected);
      $('#atlet_tunggal').show();
    }else if(valueSelected == 2){
      console.log(valueSelected);
      $('#atlet_tunggal,#atlet_ganda').show();
    }
  });

  $('#a_tunggal, #a_ganda').on('change', function(){
    $('#message').hide();
    if ($('#a_tunggal').val() == $('#a_ganda').val()) {
      $('#message').html('Atlet tidak boleh sama!');
      $('#message').show();
    }else{
      $('#message').hide();
    }
  });

  $(function(){
    $('.select2').select2();
  });
</script>
@endsection
