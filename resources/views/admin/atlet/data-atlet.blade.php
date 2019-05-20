@extends('admin.layouts.master',['activeMenu' => 'atlet'])
@section('title','Data Atlet')
@section('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    Atlet
    <small>Data Atlet</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Data Atlet</li>
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
          <h3 class="box-title">Data Atlet</h3>
        </div>
        <div class="box-body">
          <a href="{{url('admin/atlet/tambah-atlet')}}" class="btn btn-primary btn-md" style="margin-bottom: 5px">
            <i class="fa fa-plus"></i>
            Tambah Atlet Baru
          </a>
          <div class="table-responsive">
            <table id="tabelAtlet" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Atlet</th>
                  <th>Nama</th>
                  <th>TTL</th>
                  <th>Klub</th>
                  <th>Cabang</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($atlets as $atlet)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$atlet->kode_atlet}}</td>
                    <td>{{$atlet->nama}}</td>
                    <td>{{$atlet->tempat_lahir}}, {{date('d-m-Y', strtotime($atlet->tgl_lahir))}}</td>
                    <td>{{$atlet->club->nama_klub}}</td>
                    <td>{{$atlet->club->alamat}}</td>
                    <td>
                      @if($atlet->status == 'aktif')
                        <span class="label label-success">Aktif</span>
                      @else
                        <span class="label label-danger">Non Aktif</span>
                      @endif
                    </td>
                    <td>{{$atlet->created_at->format('d-m-Y')}}</td>
                    <td>
                      <a href="javascript:void(0);" class="fa fa-eye" onclick="showImage('{{$atlet->foto}}')"></a>
                      <a href="{{url('admin/atlet/'.$atlet->id.'/edit-atlet')}}" class="fa fa-pencil"></a>
                      <a href="javascript:void(0);" class="fa fa-trash" onclick="deleteAtlet('{{$atlet->id}}')"></a>
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
    function showImage(foto){
      bootbox.dialog({
        message: '<img src="{{asset('backend/images/atlet')}}/'+foto+'" class="img-responsive">',
        closeButton: true,
        size: 'small'
      });
    }
    function deleteAtlet(id_atlet){
        bootbox.confirm("Anda yakin ingin menghapus atlet ini secara permanen ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url('admin/atlet')}}/'+id_atlet);
                $('#formDelete').submit();
            }
        });
    }
    $(function(){
      $('#tabelAtlet').dataTable()
    })
  </script>
@endsection
