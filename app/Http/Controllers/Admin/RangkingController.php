<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use Validator;
use App\Category;
use App\Atlet;
use App\Ranking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RangkingController extends Controller
{
    public function indexKategori(){
      $categories = Category::all();
      return view('admin.rangking.kategori', compact('categories'));
    }

    public function simpanKategori(Request $r){
      $validator = Validator::make($r->all(),[
        'kategori' => 'required'
      ]);

      if (!$validator->fails()) {
        $check_kategori = Category::where('kategori','=',$r->kategori)->first();
        if ($check_kategori == null) {
          $categories = Category::create([
            'kategori' => $r->kategori,
            'deskripsi' => $r->deskripsi
          ]);
          Session::flash('success', 'Kategori baru berhasil di tambahkan !');
          return redirect('admin/kategori');
        }else{
          Session::flash('error', 'Kategori '.$r->kategori.' sudah ada !');
          return redirect()->back()->withInput();
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function updateKategori(Request $r, $id_kategori){
      $validator = Validator::make($r->all(),[
        'kategori' => 'required'
      ]);

      if (!$validator->fails()) {
        $categories = Category::findOrFail($id_kategori)->update([
          'kategori' => $r->kategori,
          'deskripsi' => $r->deskripsi
        ]);
        Session::flash('success', 'Kategori yang dipilih berhasil diubah !');
        return redirect('admin/kategori');
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function deleteKategori($id_kategori){
      $kategori = Category::where('id',$id_kategori)->delete();
      Session::flash('success', 'Kategori yang terpilih berhasil dihapus !');
      return redirect('admin/kategori');
    }

    public function tambahRangking(){
      $categories = Category::all();
      $atlets = Atlet::where('status','=','aktif')->get();
      return view('admin.rangking.tambah-rangking', compact('categories','atlets'));
    }
}
