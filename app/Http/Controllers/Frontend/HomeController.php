<?php

namespace App\Http\Controllers\Frontend;

use App\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
      $beritas = Berita::where('status','=','published')->paginate(5);
      return view('frontend.home.index', compact('beritas'));
    }
}
