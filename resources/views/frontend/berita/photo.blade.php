<div class="span3">
  <div class="widget-box">
    <div class="widget-title"><span class="icon"><i class="icon-file"></i></span>
      <h5>Foto Terbaru</h5>
    </div>
    <div class="widget-content nopadding">
      <ul class="recent-posts">
        @foreach($photos as $photo)
        <div class="card mb-4" style="margin-top: 5px; margin-left: 5px; margin-right: 5px">
          <div class="row no-gutters">
            <div class="col-md-12">
              <a class="thumbnail lightbox_trigger" href="{{asset('backend/images/photo/'.$photo->gambar)}}">
                <img src="{{asset('backend/images/photo/'.$photo->gambar)}}">
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </ul>
    </div>
  </div>
</div>
