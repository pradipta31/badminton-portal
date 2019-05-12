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
                Image::make($gambar)->resize(365, 280)->save(public_path('/backend/images/berita/'.$filename));
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
            return redirect('admin/berita/data-berita');
          }else{
            Session::flash('error', 'Judul berita '.$r->judul.' sudah ada !');
            return redirect()->back()->withInput();
          }
        }elseif($r->get('archive')){
          $check_slug = Berita::where('slug','=', str_slug($r->judul))->first();
          if ($check_slug == null) {
            $gambar = $r->file('gambar');
            $filename = time() . '.' . $gambar->getClientOriginalExtension();
            if ($r->file('gambar')->isValid()) {
                Image::make($gambar)->resize(365, 280)->save(public_path('/backend/images/berita/'.$filename));
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
            return redirect('admin/berita/data-berita');
          }else{
            Session::flash('error', 'Judul berita '.$r->judul.' sudah ada !');
            return redirect()->back()->withInput();
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

    public function updateBerita(Request $r, $id_berita){
      $validator = Validator::make($r->all(), [
        'judul' => 'required',
        'isi' => 'required'
      ]);

      if (!$validator->fails()) {
        if($r->get('publish')){
            if ($r->hasFile('gambar') == 0) {
                $berita = Berita::findOrFail($id_berita)->update([
                    'judul' => $r->judul,
                    'slug' => str_slug($r->judul),
                    'isi' => $r->isi,
                    'status' => 'published'
                ]);
            }elseif ($r->hasFile('gambar')){
                $gambar = $r->file('gambar');
                $filename = time() . '.' . $gambar->getClientOriginalExtension();
                Image::make($gambar)->resize(365, 280)->save(public_path('/backend/images/berita/'.$filename));
                $file = Berita::findOrFail($id_berita)->update([
                    'judul' => $r->judul,
                    'slug' => str_slug($r->judul),
                    'isi' => $r->isi,
                    'file' => $filename,
                    'status' => 'published'
                ]);
            }elseif($r->all() == 0){
                Session::flash('success', 'Berita berhasil ditampilkan !');
                return redirect('admin/berita/data-berita');
            }
            Session::flash('success', 'Perubahan berita baru berhasil ditampilkan !');
            return redirect('admin/berita/data-berita');
        }elseif($r->get('archive')){
            if ($r->hasFile('gambar') == 0) {
                $file = Berita::findOrFail($id_berita)->update([
                    'judul' => $r->judul,
                    'slug' => str_slug($r->judul),
                    'isi' => $r->isi,
                    'status' => 'archived'
                ]);
            }elseif ($r->hasFile('gambar')){
                $gambar = $r->file('gambar');
                $filename = time() . '.' . $gambar->getClientOriginalExtension();
                Image::make($gambar)->resize(365, 280)->save(public_path('/backend/images/berita/'.$filename));
                $file = Berita::findOrFail($id_berita)->update([
                    'judul' => $r->judul,
                    'slug' => str_slug($r->judul),
                    'isi' => $r->isi,
                    'file' => $filename,
                    'status' => 'archived'
                ]);
            }
            Session::flash('success', 'Berita berhasil disimpan ke draft !');
            return redirect('admin/berita/data-berita');
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function deleteBerita($id_berita){
      $berita = Berita::where('id',$id_berita)->delete();
      Session::flash('success', 'Berita berhasil yang terpilih berhasil dihapus !');
      return redirect('admin/berita/data-berita');
    }
}
