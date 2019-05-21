<div class="row-fluid">
  <div class="span12">
    <div class="widget-box">
      <div class="widget-title"><span class="icon"><i class="icon-file"></i></span>
        <h5>Latest Posts</h5>
      </div>
      <div class="widget-content nopadding">
        <ul class="recent-posts">
          @foreach($beritas as $berita)
          <li>
            <div class="thumb"> <img width="40" height="40" alt="User" src="{{asset('backend/images/berita/'.$berita->gambar)}}"> </div>
            <div class="article-post"> <span class="user-info"> Dari: {{$berita->user->nama}} / Tanggal: {{$berita->created_at->format('d-m-Y')}} </span>
              <p><a href="{{url('berita/'.$berita->slug)}}">{{$berita->judul}}</a> </p>
            </div>
          </li>
          @endforeach
          {{$beritas->links()}}
          <li>
            <button class="btn btn-primary btn-mini">View All</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
