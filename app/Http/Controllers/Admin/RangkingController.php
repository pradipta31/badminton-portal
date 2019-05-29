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
            'kode_kategori' => $r->kode_kategori,
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
        'kode_kategori' => 'required',
        'kategori' => 'required'
      ]);

      if (!$validator->fails()) {
        $categories = Category::findOrFail($id_kategori)->update([
          'kode_kategori' => $r->kode_kategori,
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

    public function simpanRangking(Request $r){
      $validator = Validator::make($r->all(), [
        'id_kategori' => 'required',
        'id_atlet' => 'required',
        'ranking' => 'required',
        'total_main' => 'required',
        'total_poin' => 'required'
      ]);

      if (!$validator->fails()) {
        $check = Ranking::where('id_atlet','=',$r->id_atlet)->first();
        $check_atlet = Atlet::where('id','=',$r->id_atlet)->first();
        if ($check == null) {
          if ($r->kode_kategori == '1') {
            $atlet_tunggal = Ranking::create([
              'id_kategori' => $r->id_kategori,
              'id_atlet' => $r->id_atlet,
              'ranking' => $r->ranking,
              'total_main' => $r->total_main,
              'total_poin' => $r->total_poin
            ]);
            Session::flash('success', 'Ranking baru berhasil didaftarkan !');
            return redirect('admin/rangking/daftar-rangking');
          }else{
            $check_pas = Ranking::where('id_atlet','=',$r->id_pas_atlet)
            ->where('id_pas_atlet','=',$r->id_atlet)
            ->where('id_pas_atlet', '=', $r->id_pas_atlet)
            ->first();
            if ($check_pas == null) {
              $atlet_ganda = Ranking::create([
                'id_kategori' => $r->id_kategori,
                'id_atlet' => $r->id_atlet,
                'id_pas_atlet' => $r->id_pas_atlet,
                'ranking' => $r->ranking,
                'total_main' => $r->total_main,
                'total_poin' => $r->total_poin
              ]);
              Session::flash('success', 'Ranking baru berhasil didaftarkan !');
              return redirect('admin/rangking/daftar-rangking');
            }else{
              Session::flash('error', 'Atlet '.$check_atlet->nama.' sudah terdaftar !');
              return redirect()->back()->withInput();
            }
          }
        }else{
          Session::flash('error', 'Atlet '.$check_atlet->nama.' sudah terdaftar !');
          return redirect()->back()->withInput();
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function indexRanking(){
      $rankings = Ranking::orderBy('id_kategori','asc')->get();
      return view('admin.rangking.data-rangking',compact('rankings'));
    }
}
