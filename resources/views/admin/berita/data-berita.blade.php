@extends('admin.layouts.master')
@section('title','Tambah Berita')
@section('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    Berita
    <small>Data Berita</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Data Berita</li>
  </ol>
</section>
<section class="content">
  @if (Session::has('success'))
      <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Information !</h4>
          {{Session::get('success')}}
      </div>
  @elseif (Session::has('error'))
      <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Information !</h4>
          {{Session::get('error')}}
      </div>
  @endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Berita</h3>
        </div>
        <div class="box-body">
          <a href="{{url('admin/berita/tambah-berita')}}" class="btn btn-primary btn-md" style="margin-bottom: 5px">
            <i class="fa fa-plus"></i>
            Tambah Berita Baru
          </a>
          <div class="table-responsive">
            <table id="tabelBerita" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Admin</th>
                  <th>Judul</th>
                  <th>Cover</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($beritas as $berita)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$berita->user->nama}}</td>
                    <td>{{$berita->judul}}</td>
                    <td>
                      <button class="btn btn-primary btn-sm" onClick="showImage('{{$berita->gambar}}');">
                        <i class="fa fa-eye"></i>
                      </button>
                    </td>
                    <td>
                      @if($berita->status == 'published')
                        <span class="label label-success">Published</span>
                      @else
                        <span class="label label-warning">Archived</span>
                      @endif
                    </td>
                    <td>{{$berita->created_at->format('d-m-Y')}}</td>
                    <td>
                      <a href="{{url('admin/berita/'.$berita->id.'/edit-berita')}}" class="fa fa-pencil"></a>
                      <a href="javascript:void(0);" class="fa fa-trash" onclick="deleteBerita('{{$berita->id}}')"></a>
                    </td>
                  </tr>
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
    function showImage(gambar){
      bootbox.dialog({
        message: '<img src="{{asset('backend/images/berita')}}/'+gambar+'" class="img-responsive">',
        closeButton: true,
        size: 'small'
      });
    }
    function deleteBerita(id_berita){
        bootbox.confirm("Anda yakin ingin menghapus berita ini secara permanen ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url('admin/berita')}}/'+id_berita);
                $('#formDelete').submit();
            }
        });
    }
    $(function(){
      $('#tabelBerita').dataTable()
    })
  </script>
@endsection
