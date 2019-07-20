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
      $kategori = Category::where('id','=','1')->first();
      $categories = Category::all();
      $rangkings = Ranking::where('id_kategori','=','1')->get();
      return view('frontend.rangking.index', compact('rangkings','kategori','categories'));
    }

    public function cari(Request $r){
      $search = $r->all();
      //dd($search);
      $id_kategori = $r->id_kategori;
      $results = [];
      if ($search) {
        $results = Ranking::where('id_kategori', 'LIKE', '%'. $id_kategori .'%')
        ->get();
        if ($results != null) {
          $kategori = Category::where('id',$id_kategori)->first();
          $categories = Category::all();
          return view('frontend.rangking.cari-rangking')->with([
            'categories' => $categories,
            'kategori' => $kategori,
            'results' => $results
          ]);
        }else{
          dd('tidak ditemukan');
        }
      }
    }
}
