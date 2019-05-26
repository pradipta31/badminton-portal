<?php

namespace App\Http\Controllers\Frontend;

use App\Berita;
use App\Kejuaraan;
use App\DetailGallery;
use App\DetailKejuaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KejuaraanController extends Controller
{
    public function indexKejuaraan(){
      $kejuaraans = Kejuaraan::all();
      return view('frontend.kejuaraan.index', compact('kejuaraans'));
    }

    public function detailKejuaraan($id){
      $kejuaraan = DetailKejuaraan::where('id_kejuaraan', $id)->first();
      $kejuaraans = Kejuaraan::where('id',$id)->first();
      $beritas = Berita::where('status','=','published')
      ->orderBy('created_at','desc')
      ->paginate(3);
      $photos = DetailGallery::orderBy('created_at', 'desc')->paginate(3);
      return view('frontend.kejuaraan.detail-kejuaraan', compact('kejuaraan', 'kejuaraans', 'beritas', 'photos'));
    }
}
