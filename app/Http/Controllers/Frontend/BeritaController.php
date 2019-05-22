<?php

namespace App\Http\Controllers\Frontend;

use App\Gallery;
use App\DetailGallery;
use App\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
{
  public function semuaBerita(){
    $beritas = Berita::where('status','=','published')->paginate(10);
    $photos = DetailGallery::orderBy('created_at', 'desc')->paginate(3);
    return view('frontend.berita.semua-berita', compact('beritas', 'photos'));
  }

  public function bacaBerita($slug){
    $berita = Berita::where('slug', '=', $slug)->first();
    $beritas = Berita::where('status','=','published')
    ->orderBy('created_at','desc')
    ->paginate(3);
    $photos = DetailGallery::orderBy('created_at', 'desc')->paginate(3);
    return view('frontend.berita.baca-berita', compact('berita', 'beritas', 'photos'));
  }
}
