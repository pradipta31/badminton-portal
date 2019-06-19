<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Atlet;
use App\Ranking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RangkingController extends Controller
{
    public function index(){
      $rangkings = Ranking::all();
      return view('frontend.rangking.index', compact('rangkings'));
    }
}
