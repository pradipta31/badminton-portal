@extends('admin.layouts.master',['activeMenu' => 'gallery'])
@section('title','Data Gallery')
@section('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    Gallery
    <small>Data Gallery</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Data Gallery</li>
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
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Gallery</h3>
        </div>
        <div class="box-body">
          <a href="{{url('admin/gallery/tambah-gallery')}}" class="btn btn-primary btn-md" style="margin-bottom: 5px">
            <i class="fa fa-plus"></i>
            Tambah Gallery Baru
          </a>
          <div class="table-responsive">
            <table id="tabelGallery" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Admin</th>
                  <th>Judul</th>
                  <th>Cover</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Gallery</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($galleries as $gallery)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$gallery->user->nama}}</td>
                    <td>{{$gallery->judul}}</td>
                    <td>
                      <button class="btn btn-primary btn-sm" onClick="showImage('{{$gallery->gambar}}');">
                        <i class="fa fa-eye"></i>
                      </button>
                    </td>
                    <td>
                      @if($gallery->status == 'aktif')
                        <span class="label label-success">Aktif</span>
                      @else
                        <span class="label label-danger">Non Aktif</span>
                      @endif
                    </td>
                    <td>{{$gallery->created_at->format('d-m-Y')}}</td>
                    <td>
                      <a href="#" class="btn btn-success btn-sm">Tambah Foto</a>
                    </td>
                    <td>
                      <a href="#" class="fa fa-pencil" data-toggle="modal" data-target="#editGallery{{$gallery->id}}"></a>
                      <!-- <a href="javascript:void(0);" class="fa fa-trash" onclick="deleteBerita('{{$gallery->id}}')"></a> -->

                    </td>
                  </tr>
                  <!-- Edit Gallery -->
                  <div class="modal fade" id="editGallery{{$gallery->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Edit Gallery : {{$gallery->judul}}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('admin/gallery/'.$gallery->id)}}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="put">
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Judul Gallery</label>
                              <input type="text" class="form-control" placeholder="Judul Gallery" name="judul" value="{{$gallery->judul}}">
                            </div>
                            <div class="form-group">
                              <label>Cover Gambar</label>
                              <input type="file" name="gambar" class="form-control">
                              <small>Note: Kosongkan jika tidak ingin mengubah cover gambar.</small>
                            </div>
                            <div class="form-group">
                              <label>Deskripsi</label>
                              <textarea name="deskripsi" rows="4" class="form-control">{{$gallery->deskripsi}}</textarea>
                            </div>
                            <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status" value="{{$gallery->status}}">
                                <option value="aktif" {{$gallery->status == 'aktif' ? 'selected' : ''}}>Aktif</option>
                                <option value="nonaktif" {{$gallery->status == 'nonaktif' ? 'selected' : ''}}>Tidak Aktif</option>
                              </select>
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
    function showEditGallery(){
      $('#editGallery').modal('show');
    }
    function showImage(gambar){
      bootbox.dialog({
        message: '<img src="{{asset('backend/images/gallery')}}/'+gambar+'" class="img-responsive">',
        closeButton: true,
        size: 'small'
      });
    }
    function deleteBerita(id_gallery){
        bootbox.confirm("Anda yakin ingin menghapus berita ini secara permanen ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url('admin/gallery')}}/'+id_gallery);
                $('#formDelete').submit();
            }
        });
    }
    $(function(){
      $('#tabelGallery').dataTable()
    })
  </script>
@endsection
