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
				<h5>Gallery : {{$g->judul}}</h5>
			</div>
			<div class="widget-content">
        <ul class="thumbnails">
          @foreach($galleries as $gallery)
            <li class="span2">
              <a class="thumbnail lightbox_trigger" href="{{asset('backend/images/photo/'.$gallery->gambar)}}">
                <img src="{{asset('backend/images/photo/'.$gallery->gambar)}}" alt="" >
              </a>
            </li>
          @endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
