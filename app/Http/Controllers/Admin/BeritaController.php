<?php

namespace App\Http\Controllers\Admin;

use Image;
use Auth;
use Session;
use Validator;
use App\User;
use App\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
{
    public function tambahBerita(){
      return view('admin.berita.tambah-berita');
    }

    public function simpanBerita(Request $r){
      $validator = Validator::make($r->all(), [
        'judul' => 'required',
        'isi' => 'required',
        'gambar' => 'required'
      ]);

      if (!$validator->fails()) {
        if ($r->get('publish')) {
          $check_slug = Berita::where('slug','=', str_slug($r->judul))->first();
          if ($check_slug == null) {
            $gambar = $r->file('gambar');
            $filename = time() . '.' . $gambar->getClientOriginalExtension();
            if ($r->file('gambar')->isValid()) {
                Image::make($gambar)->resize(600, 321)->save(public_path('/backend/images/berita/'.$filename));
                $file = Berita::create([
                    'judul' => $r->judul ?? $uploadedFile->getClientOriginalName(),
                    'slug' => str_slug($r->judul),
                    'isi' => $r->isi,
                    'gambar' => $filename,
                    'status' => 'published',
                    'id_user' => Auth::id()
                ]);
            }
            Session::flash('success', 'Berita baru berhasil di publikasikan !');
            return redirect('admin/berita');
          }else{
            Session::flash('error', 'Berita sudah ada !');
            return redirect('admin/berita/tambah-berita');
          }
        }elseif($r->get('archive')){
          $check_slug = Berita::where('slug','=', str_slug($r->judul))->first();
          if ($check_slug == null) {
            $gambar = $r->file('gambar');
            $filename = time() . '.' . $gambar->getClientOriginalExtension();
            if ($r->file('gambar')->isValid()) {
                Image::make($gambar)->resize(600, 321)->save(public_path('/backend/images/berita/'.$filename));
                $file = Berita::create([
                    'judul' => $r->judul ?? $uploadedFile->getClientOriginalName(),
                    'slug' => str_slug($r->judul),
                    'isi' => $r->isi,
                    'gambar' => $filename,
                    'status' => 'archived',
                    'id_user' => Auth::id()
                ]);
            }
            Session::flash('success', 'Berita berhasil disimpan di draft !');
            return redirect('admin/berita');
          }else{
            Session::flash('error', 'Berita sudah ada !');
            return redirect('admin/berita/tambah-berita');
          }
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function indexBerita(){
      $beritas = Berita::all();
      return view('admin.berita.data-berita', compact('beritas'));
    }

    public function editBerita($id_berita){
      $berita = Berita::where('id', $id_berita)->first();
      return view('admin.berita.edit-berita', compact('berita'));
    }
}
