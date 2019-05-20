@extends('admin.layouts.master',['activeMenu' => 'atlet'])
@section('title','Data Klub')
@section('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    Klub
    <small>Data Klub</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Data Klub</li>
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
          <h3 class="box-title">Tambah Klub Baru</h3>
        </div>
        <form action="{{url('admin/klub/tambah-klub')}}" method="post">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label>Nama Klub</label>
              <input type="text" class="form-control" placeholder="Nama Klub" name="nama_klub">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea name="alamat" rows="3" cols="80" class="form-control"></textarea>
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
          <h3 class="box-title">Data Klub</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="tabelKlub" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Klub</th>
                  <th>Deskripsi</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($clubs as $club)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$club->nama_klub}}</td>
                    <td>{{$club->alamat}}</td>
                    <td>
                      @if($club->status == 'aktif')
                        <span class="label label-success">Aktif</span>
                      @else
                        <span class="label label-danger">Non Aktif</span>
                      @endif
                    </td>
                    <td>
                      <a href="#" class="fa fa-pencil" data-toggle="modal" data-target="#editKlub{{$club->id}}"></a>
                      <!-- <a href="javascript:void(0);" class="fa fa-trash" onclick="deleteKlub('{{$club->id}}')"></a> -->
                    </td>
                  </tr>
                  <!-- EDIT KATEGORI -->
                  <div class="modal fade" id="editKlub{{$club->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Edit Kategori : {{$club->nama_klub}}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('admin/klub/'.$club->id)}}" method="post">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="put">
                          <div class="modal-body">
                              <div class="form-group">
                                <label class="col-form-label">Nama Klub</label>
                                <input type="text" class="form-control" name="nama_klub" value="{{$club->nama_klub}}">
                              </div>
                              <div class="form-group">
                                <label class="col-form-label">Alamat</label>
                                <textarea class="form-control" name="alamat">{{$club->alamat}}</textarea>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label">Status</label>
                                <select class="form-control" name="status" value="{{$club->status}}">
                                  <option value="aktif" {{$club->status == 'aktif' ? 'selected' : ''}}>Aktif</option>
                                  <option value="nonaktif" {{$club->status == 'nonaktif' ? 'selected' : ''}}>Non Aktif</option>
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
    function showDetail() {
        $('#editKlub').modal('show');
    }
    function deleteKlub(id_klub){
        bootbox.confirm("Anda yakin ingin menghapus data klub ini secara permanen ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url('admin/klub')}}/'+id_klub);
                $('#formDelete').submit();
            }
        });
    }
    $(function(){
      $('#tabelKlub').dataTable()
    })
  </script>
@endsection
