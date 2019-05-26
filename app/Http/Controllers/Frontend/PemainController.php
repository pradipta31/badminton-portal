<?php

namespace App\Http\Controllers\Frontend;

use App\Club;
use App\Atlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PemainController extends Controller
{
  public function getPemain(){
    $atlets = Atlet::all();
    return view('frontend.pemain.index', compact('atlets'));
  }
}
