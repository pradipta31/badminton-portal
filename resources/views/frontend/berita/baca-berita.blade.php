@extends('frontend.layouts.app')
@section('css')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
@section('title','Berita')
@section('content')
<style media="screen">
  #header{
    margin-top: 0;
  }

  #imgbox img{
    margin-top: 100px;
  }
</style>
<div class="row-fluid">
  <div class="span9">
    <div class="widget-box">
      <div class="widget-title"><span class="icon"><i class="icon-file"></i></span>
        <h5>{{$berita->judul}} <small class="text-muted">{{$berita->created_at->format('d-m-Y')}}, Posted By: {{$berita->user->nama}}</small></h5>
      </div>
      <div class="widget-content nopadding">
        <ul class="recent-posts">
          <div class="card mb-3" style="margin-top: 10px; margin-left: 5px; margin-right: 5px">
            <div class="row no-gutters">
              <h2 class="card-title">
                <span style="margin-left: 5px">{{$berita->judul}}</span>
                <small class="text-muted">{{$berita->created_at->format('d-m-Y')}}, Posted By: {{$berita->user->nama}}</small>
              </h2>
              <div class="col-md-8" style="margin-top: 8px; margin-left: 5px; margin-right: -5px; left: 15%">
                <img src="{{asset('backend/images/berita/'.$berita->gambar)}}" class="card-img" alt="...">
              </div>
              <div class="col-md-4">

              </div>
              <div class="col-md-12">
                <div class="card-body">
                  <p class="card-text">{!! $berita->isi !!}</p>
                </div>
              </div>
            </div>
          </div>
        </ul>
      </div>
    </div>
  </div>
  @include('frontend.berita.berita')
  @include('frontend.berita.photo')

</div>

@endsection
