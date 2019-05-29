@extends('admin.layouts.master',['activeMenu' => 'kategori-rangking'])
@section('title','Data Kategori')
@section('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    Kategori
    <small>Data Kategori</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Data Kategori</li>
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
          <h3 class="box-title">Tambah Kategori Baru</h3>
        </div>
        <form action="{{url('admin/kategori/tambah-kategori')}}" method="post">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label>Kode Kategori</label>
              <select class="form-control" name="kode_kategori">
                <option value="1">Tunggal</option>
                <option value="2">Ganda</option>
              </select>
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <input type="text" class="form-control" placeholder="Kategori" name="kategori">
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea name="deskripsi" rows="3" cols="80" class="form-control"></textarea>
              <small>Note: Deskripsi dapat dikosongkan</small>
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
          <h3 class="box-title">Data Kategori</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="tabelKategori" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Kategori</th>
                  <th>Kategori</th>
                  <th>Deskripsi</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($categories as $kategori)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>
                      @if($kategori->kode_kategori == '1')
                        Tunggal
                      @else
                        Ganda
                      @endif
                    </td>
                    <td>{{$kategori->kategori}}</td>
                    <td>{{$kategori->deskripsi}}</td>
                    <td>
                      <a href="#" class="fa fa-pencil" data-toggle="modal" data-target="#editKategori{{$kategori->id}}"></a>
                      <a href="javascript:void(0);" class="fa fa-trash" onclick="deleteKategori('{{$kategori->id}}')"></a>
                    </td>
                  </tr>
                  <!-- EDIT KATEGORI -->
                  <div class="modal fade" id="editKategori{{$kategori->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Edit Kategori : {{$kategori->kategori}}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('admin/kategori/'.$kategori->id)}}" method="post">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="put">
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="col-form-label">Kode Kategori</label>
                              <select class="form-control" name="kode_kategori" value="{{$kategori->kode_kategori}}">
                                <option value="1" {{$kategori->kode_kategori == '1' ? 'selected' : ''}}>Tunggal</option>
                                <option value="2" {{$kategori->kode_kategori == '2' ? 'selected' : ''}}>Ganda</option>
                              </select>
                            </div>
                              <div class="form-group">
                                <label class="col-form-label">Kategori</label>
                                <input type="text" class="form-control" name="kategori" value="{{$kategori->kategori}}">
                              </div>
                              <div class="form-group">
                                <label class="col-form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi">{{$kategori->deskripsi}}</textarea>
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
    function deleteKategori(id_kategori){
        bootbox.confirm("Anda yakin ingin menghapus data kategori ini secara permanen ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url('admin/kategori')}}/'+id_kategori);
                $('#formDelete').submit();
            }
        });
    }
    $(function(){
      $('#tabelKategori').dataTable()
    })
  </script>
@endsection
