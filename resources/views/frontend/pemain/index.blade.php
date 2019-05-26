<!DOCTYPE html>
<html lang="en">
<head>
<title>Maruti Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/uniform.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/select2.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/maruti-style.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/maruti-media.css')}}" class="skin-color" />
</head>
<body>

  <div id="header">
    <h1>
      <a href="dashboard.html" style="color: white; margin-left: 5px; font-family: 'Comic Sans MS', cursive, sans-serif; font-size: 25px; text-decoration: none">
        Badminton Portal
      </a>
  </h1>
  </div>

@include('frontend.layouts.navigation')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span>
            <h5>Daftar Atlet</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Atlet</th>
                  <th>Nama</th>
                  <th>TTL</th>
                  <th>Klub</th>
                  <th>Cabang</th>
                  <th>Foto</th>
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
                      <center>
                        <a href="javascript:void(0);" class="icon icon-picture" onclick="showImage('{{$atlet->foto}}')"></a>
                      </center>
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
</div>
@include('frontend.layouts.footer')
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.ui.custom.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.uniform.js')}}"></script>
<script src="{{asset('frontend/js/select2.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('frontend/js/maruti.js')}}"></script>
<script src="{{asset('frontend/js/maruti.tables.js')}}"></script>
<script src="{{asset('backend/plugins/bootbox/bootbox.min.js')}}"></script>
<script type="text/javascript">
  function showImage(foto){
    bootbox.dialog({
      message: '<img src="{{asset('backend/images/atlet')}}/'+foto+'" class="img-responsive">',
      closeButton: true,
      size: 'small'
    });
  }
</script>
</body>
</html>
