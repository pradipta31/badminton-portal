@extends('admin.layouts.master',['activeMenu' => 'kategori-rangking'])
@section('title','Daftar Rangking')
@section('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    Rangking
    <small>Daftar Rangking</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Daftar Rangking</li>
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
          <h3 class="box-title">Daftar Rangking</h3>
        </div>
        <div class="box-body">
          <a href="{{url('admin/rangking/tambah-rangking')}}" class="btn btn-primary btn-md" style="margin-bottom: 5px">
            <i class="fa fa-plus"></i>
            Tambah Rangking Baru
          </a>
          <div class="table-responsive">
            <table id="tabelKejuaraan" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kategori</th>
                  <th>Rangking</th>
                  <th>Nama Atlet</th>
                  <th>Total Main</th>
                  <th>Total Poin</th>
                  <th>Update</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($rankings as $rangking)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$rangking->category->kategori}}</td>
                    <td>{{$rangking->ranking}}</td>
                    <td>
                      @if($rangking->id_pas_atlet == null)
                        {{$rangking->atlet->nama}}
                      @else
                        {{$rangking->atlet->nama}} & {{$rangking->atletP->nama}}
                      @endif
                    </td>
                    <td>{{$rangking->total_main}}</td>
                    <td>{{$rangking->total_poin}}</td>
                    <td>{{$rangking->updated_at->format('d-m-Y')}}</td>
                    <td>
                      <a href="#" class="fa fa-pencil" data-toggle="modal" data-target="#editRangking{{$rangking->id}}"></a>
                      <a href="javascript:void(0);" class="fa fa-trash" onclick="deleteRangking('{{$rangking->id}}')"></a>
                    </td>
                  </tr>
                  <!-- EDIT RANGKING -->
                  <div class="modal fade" id="editRangking{{$rangking->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Edit Rangking</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('admin/rangking/'.$rangking->id)}}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="put">
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Kategori</label>
                              <select class="form-control" name="id_kategori" disabled>
                                  <option value="0">-- Pilih Kategori --</option>
                                @foreach($categories as $kategori)
                                  <option value="{{$kategori->id}}" {{$kategori->id == $rangking->id_kategori ? 'selected' : ''}}>{{$kategori->kategori}}</option>
                                @endforeach
                              </select>
                            </div>
                            @if($rangking->id_pas_atlet != null)
                              <div class="form-group" id="atlet_tunggal">
                                <label>Pilih Atlet</label>
                                <select class="form-control" name="id_atlet" disabled>
                                  @foreach($atlets as $atlet)
                                    <option value="{{$atlet->id}}" {{$atlet->id == $rangking->id_atlet ? 'selected' : ''}}>{{$atlet->nama}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group" id="atlet_ganda">
                                <label>Pilih Pasangan Atlet</label>
                                <select class="form-control" name="id_pas_atlet" disabled>
                                  @foreach($atlets as $atlet)
                                    <option value="{{$atlet->id}}" {{$atlet->id == $rangking->id_pas_atlet ? 'selected' : ''}}>{{$atlet->nama}}</option>
                                  @endforeach
                                </select>
                              </div>
                            @else
                              <div class="form-group" id="atlet_tunggal">
                                <label>Pilih Atlet</label>
                                <select class="form-control" name="id_atlet" disabled>
                                  @foreach($atlets as $atlet)
                                    <option value="{{$atlet->id}}" {{$atlet->id == $rangking->id_atlet ? 'selected' : ''}}>{{$atlet->nama}}</option>
                                  @endforeach
                                </select>
                              </div>
                            @endif
                            <div class="form-group">
                              <label>Rangking</label>
                              <input type="number" class="form-control" placeholder="Rangking" name="ranking" value="{{$rangking->ranking}}">
                            </div>
                            <div class="form-group">
                              <label>Total Main</label>
                              <input type="number" class="form-control" placeholder="Total Main" name="total_main" value="{{$rangking->total_main}}">
                            </div>
                            <div class="form-group">
                              <label>Total Poin</label>
                              <input type="number" class="form-control" placeholder="Total Poin" name="total_poin" value="{{$rangking->total_poin}}">
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
  <script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    function showModalEdit() {
        $('#editRangking').modal('show');
    }
    function deleteRangking(id_rangking){
        bootbox.confirm("Anda yakin ingin menghapus rangking ini secara permanen ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url('admin/rangking')}}/'+id_rangking);
                $('#formDelete').submit();
            }
        });
    }
    $(function(){
      $('#tabelKejuaraan').dataTable()
    });
  </script>
@endsection
