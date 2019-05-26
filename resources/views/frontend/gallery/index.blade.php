@extends('frontend.layouts.app')
@section('css')
@endsection
@section('title','Gallery Badminton')
@section('content')
<div class="row-fluid">
	<div class="span12">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon">
					<i class="icon-picture"></i>
				</span>
				<h5>Gallery</h5>
			</div>
			<div class="widget-content">
        <ul class="thumbnails">
          @foreach($galleries as $gallery)
            <li class="span2">
              <a class="thumbnail lightbox_trigger" href="{{asset('backend/images/gallery/'.$gallery->gambar)}}">
                <img src="{{asset('backend/images/gallery/'.$gallery->gambar)}}" alt="" >
              </a>
              <p class="caption">
                <a href="{{url('gallery/detail/'.$gallery->id)}}" style="color: grey"> {{$gallery->judul}} </a>
              </p>
            </li>
          @endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
