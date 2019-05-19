@extends('admin.layouts.master',['activeMenu' => 'gallery'])
@section('title','Daftar Foto')
@section('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    Foto
    <small>Daftar Foto</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Daftar Foto</li>
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
  <div class="row">
    <div class="col-xs-4">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Foto Baru : {{$gallery->judul}}</h3>
        </div>
        <form action="{{url('admin/gallery/tambah-foto')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="id_gallery" value="{{$gallery->id}}">
          <div class="box-body">
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" class="form-control" name="gambar">
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-xs-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Daftar Foto</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="tabelFoto" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Foto</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($photos as $photo)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$photo->gallery->judul}}</td>
                    <td>
                      <a href="#" onClick="showImage('{{$photo->gambar}}');">
                        <img src="{{asset('backend/images/photo/'.$photo->gambar)}}" alt="" width="75px" height="75px">
                      </a>
                    </td>
                    <td>
                      <a href="#" class="fa fa-pencil" data-toggle="modal" data-target="#editKategori{{$photo->id}}"></a>
                      <a href="javascript:void(0);" class="fa fa-trash" onclick="deletePhoto('{{$photo->id}}')"></a>
                    </td>
                  </tr>
                  <!-- EDIT KATEGORI -->
                  <div class="modal fade" id="editKategori{{$photo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Edit Foto</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('admin/gallery/tambah-foto/'.$photo->id)}}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="put">
                          <input type="hidden" name="id_gallery" value="{{$photo->id_gallery}}">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Gambar</label>
                              <input type="file" class="form-control" name="gambar">
                              <br>
                              <a href="#" onClick="showImage('{{$photo->gambar}}');">
                                <img src="{{asset('backend/images/photo/'.$photo->gambar)}}" alt="" width="75px" height="75px">
                              </a>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<form class="hidden" action="" method="post" id="formDelete">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="delete">
</form>
@endsection
@section('js')
  <script src="{{asset('backend/plugins/bootbox/bootbox.min.js')}}"></script>
  <script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
    function showDetail() {
        $('#editKategori').modal('show');
    }
    function deletePhoto(id_foto){
        bootbox.confirm("Anda yakin ingin menghapus foto ini ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url('admin/gallery/tambah-foto')}}/'+id_foto);
                $('#formDelete').submit();
            }
        });
    }
    function showImage(gambar){
      bootbox.dialog({
        message: '<img src="{{asset('backend/images/photo')}}/'+gambar+'" class="img-responsive">',
        closeButton: true,
        size: 'medium'
      });
    }
    $(function(){
      $('#tabelFoto').dataTable()
    })
  </script>
@endsection
