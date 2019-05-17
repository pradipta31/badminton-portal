@extends('admin.layouts.master',['activeMenu' => 'kejuaraan'])
@section('title','Daftar Kejuaraan')
@section('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    Kejuaraan
    <small>Daftar Kejuaraan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Daftar Kejuaraan</li>
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
          <h3 class="box-title">Daftar Kejuaraan</h3>
        </div>
        <div class="box-body">
          <a href="{{url('admin/kejuaraan/tambah-kejuaraan')}}" class="btn btn-primary btn-md" style="margin-bottom: 5px">
            <i class="fa fa-plus"></i>
            Tambah Kejuaraan Baru
          </a>
          <div class="table-responsive">
            <table id="tabelKejuaraan" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kejuaraan</th>
                  <th>Kategori</th>
                  <th>Tanggal</th>
                  <th>Kabupaten</th>
                  <th>Hadiah</th>
                  <th>Batas Pendaftaran</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($kejuaraans as $kejuaraan)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$kejuaraan->nama_kejuaraan}}</td>
                    <td>{{$kejuaraan->kategori}}</td>
                    <td>
                      @if($kejuaraan->tgl_mulai == null)
                        {{$kejuaraan->tgl_akhir}}
                      @else
                        {{date('d-m-Y', strtotime($kejuaraan->tgl_mulai))}} - {{date('d-m-Y', strtotime($kejuaraan->tgl_akhir))}}
                      @endif
                    </td>
                    <td>{{$kejuaraan->kabupaten}}</td>
                    <td>
                      @if($kejuaraan->hadiah == null)
                        -
                      @else
                        {{$kejuaraan->hadiah}}
                      @endif
                    </td>
                    <td>
                      @if($kejuaraan->batas_pendaftaran == null)
                        -
                      @else
                        {{date('d-m-Y', strtotime($kejuaraan->batas_pendaftaran))}}
                      @endif
                    </td>
                    <td>
                      <a href="#" class="fa fa-file"></a>
                      <a href="#" class="fa fa-pencil" data-toggle="modal" data-target="#editKejuaraan{{$kejuaraan->id}}"></a>
                      <a href="javascript:void(0);" class="fa fa-trash" onclick="deleteKejuaraan('{{$kejuaraan->id}}')"></a>
                    </td>
                  </tr>
                  <!-- EDIT KEJUARAAN -->
                  <div class="modal fade" id="editKejuaraan{{$kejuaraan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Edit Kejuaraan : {{$kejuaraan->nama_kejuaraan}}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('admin/kejuaraan/'.$kejuaraan->id)}}" method="post">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="put">
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="col-form-label">Nama Kejuaraan</label>
                              <input type="text" class="form-control" placeholder="Nama kejuaraan" name="nama_kejuaraan" value="{{$kejuaraan->nama_kejuaraan}}">
                            </div>
                            <div class="form-group">
                              <label class="col-form-label">Kategori Kejuaraan</label>
                              <input type="text" class="form-control" placeholder="Kategori kejuaraan" name="kategori" value="{{$kejuaraan->kategori}}">
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Tanggal Mulai</label>
                                  <input type="date" class="form-control" name="tgl_mulai" value="{{$kejuaraan->tgl_mulai}}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Tanggal Akhir</label>
                                  <input type="date" class="form-control" name="tgl_akhir" value="{{$kejuaraan->tgl_akhir}}">
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-top: -10px; margin-bottom: 5px">
                                <small>Note: Tanggal mulai dapat dikosongkan jika kejuaraan hanya berlangsung dalam 1 hari.</small>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Kabupaten</label>
                              <select class="form-control" name="kabupaten" value="{{$kejuaraan->kabupaten}}">
                                <option value="Denpasar" {{$kejuaraan->kabupaten == 'Denpasar' ? 'selected' : ''}}>Kota Denpasar</option>
                                <option value="Badung" {{$kejuaraan->kabupaten == 'Badung' ? 'selected' : ''}}>Badung</option>
                                <option value="Gianyar" {{$kejuaraan->kabupaten == 'Gianyar' ? 'selected' : ''}}>Gianyar</option>
                                <option value="Tabanan" {{$kejuaraan->kabupaten == 'Tabanan' ? 'selected' : ''}}>Tabanan</option>
                                <option value="Karangasem" {{$kejuaraan->kabupaten == 'Karangasem' ? 'selected' : ''}}>Karangasem</option>
                                <option value="Bangli" {{$kejuaraan->kabupaten == 'Bangli' ? 'selected' : ''}}>Bangli</option>
                                <option value="Negara" {{$kejuaraan->kabupaten == 'Negara' ? 'selected' : ''}}>Negara</option>
                                <option value="Buleleng" {{$kejuaraan->kabupaten == 'Buleleng' ? 'selected' : ''}}>Buleleng</option>
                                <option value="Klungkung" {{$kejuaraan->kabupaten == 'Klungkung' ? 'selected' : ''}}>Klungkung</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Hadiah</label>
                              <input type="text" class="form-control" placeholder="Hadiah" name="hadiah" value="{{$kejuaraan->hadiah}}">
                            </div>
                            <div class="form-group">
                              <label>Batas Pendaftaran</label>
                              <input type="date" class="form-control" name="batas_pendaftaran" value="{{$kejuaraan->batas_pendaftaran}}">
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
    function showModalEdit() {
        $('#editKejuaraan').modal('show');
    }
    function deleteKejuaraan(id_kejuaraan){
        bootbox.confirm("Anda yakin ingin menghapus kejuaraan ini secara permanen ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url('admin/kejuaraan')}}/'+id_kejuaraan);
                $('#formDelete').submit();
            }
        });
    }
    $(function(){
      $('#tabelKejuaraan').dataTable()
    })
  </script>
@endsection
