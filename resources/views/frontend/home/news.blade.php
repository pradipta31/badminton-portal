<div class="row-fluid">
  <div class="span12">
    <div class="widget-box">
      <div class="widget-title"><span class="icon"><i class="icon-file"></i></span>
        <h5>Latest Posts</h5>
      </div>
      <div class="widget-content nopadding">
        <ul class="recent-posts">
          @foreach($beritas as $berita)
          <div class="card mb-3" style="margin-top: 10px; margin-left: 5px; margin-right: 5px">
            <div class="row no-gutters">
              <div class="col-md-2" style="margin-top: 8px; margin-left: 5px; margin-right: -5px">
                <img src="{{asset('backend/images/berita/'.$berita->gambar)}}" class="card-img" alt="...">
              </div>
              <div class="col-md-10">
                <div class="card-body">
                  <h5 class="card-title">
                    <a href="{{url('berita/'.$berita->slug)}}" style="text-decoration: none">{{$berita->judul}}</a>
                    <small class="text-muted">{{$berita->created_at->format('d-m-Y')}}, Posted By: {{$berita->user->nama}}</small>
                  </h5>
                  <p class="card-text">{!! str_limit($berita->isi, 499) !!}</p>
                  <a href="{{url('berita/'.$berita->slug)}}" style="text-decoration: none">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
            {{$beritas->links()}}
          <li>
            <a href="{{url('berita')}}" class="btn btn-primary btn-mini">Lihat Semua Berita</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
