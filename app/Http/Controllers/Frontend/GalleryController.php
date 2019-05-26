<?php

namespace App\Http\Controllers\Frontend;

use App\Berita;
use App\Gallery;
use App\DetailGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function getGallery(){
      $galleries = Gallery::where('status','=','aktif')->paginate(9);
      $beritas = Berita::where('status','=','published')
      ->orderBy('created_at','desc')
      ->paginate(3);
      return view('frontend.gallery.index', compact('galleries','beritas'));
    }

    public function detailGallery($id){
      $g = Gallery::where('id',$id)->first();
      $galleries = DetailGallery::where('id_gallery',$id)->get();
      return view('frontend.gallery.detail-gallery', compact('galleries', 'g'));
    }
}
