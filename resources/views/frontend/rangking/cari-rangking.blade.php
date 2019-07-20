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
        <form class="" action="{{url('rangking/cari')}}" method="get">
          <div class="span3">
            <div class="control-group">
                <label class="control-label">Pilih Kategori</label>
                <div class="controls">
                  <select name="id_kategori" value="{{$kategori->id}}">
                    @foreach($categories as $category)
                      <option value="{{$category->id}}" {{$category->id == $kategori->id ? 'selected' : ''}}>{{$category->kategori}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
          </div>
          <button type="submit" name="search" value="cari" class="btn btn-primary" style="margin-top: 25px">Cari</button>
        </form>
        <br>
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span>
            <h5>Rangking kategori : {{$kategori->kategori}}</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Rangking</th>
                  <th>Kode Atlet</th>
                  <th>Nama</th>
                  @if($kategori->kode_kategori == 2)
                  <th>Pasangan</th>
                  @else

                  @endif
                  <th>Klub</th>
                  <th>Total Main</th>
                  <th>Total Poin</th>
                </tr>
              </thead>
              <tbody>
                @foreach($results as $rangking)
                  <tr>
                    <td><center>{{$rangking->ranking}}</center></td>
                    <td>
                      {{$rangking->atlet->kode_atlet}}
                      @if($kategori->kode_kategori == 2)
                      / {{$rangking->atletP->kode_atlet}}
                      @else

                      @endif
                    </td>
                    <td>{{$rangking->atlet->nama}}</td>
                    @if($kategori->kode_kategori == 2)
                    <td>{{$rangking->atletP->nama}}</td>
                    @else
                    
                    @endif
                    <td>{{$rangking->atlet->club->nama_klub}}</td>
                    <td>{{$rangking->total_main}}</td>
                    <td>{{$rangking->total_poin}}</td>
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
