<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Image;
use Session;
use Validator;
use App\User;
use App\Gallery;
use App\DetailGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function tambahGallery(){
      return view('admin.gallery.tambah-gallery');
    }

    public function simpanGallery(Request $r){
      $validator = Validator::make($r->all(), [
        'judul' => 'required',
        'gambar' => 'required',
        'deskripsi' => 'required'
      ]);
      if (!$validator->fails()) {
        $check_slug = Gallery::where('slug','=', str_slug($r->judul))->first();
        if ($check_slug == null) {
          $gambar = $r->file('gambar');
          $filename = time() . '.' . $gambar->getClientOriginalExtension();
          if ($r->file('gambar')->isValid()) {
            Image::make($gambar)->resize(365, 280)->save(public_path('/backend/images/gallery/'.$filename));
            $gallery = Gallery::create([
                'judul' => $r->judul,
                'slug' => str_slug($r->judul),
                'gambar' => $filename,
                'deskripsi' => $r->deskripsi,
                'status' => 'aktif',
                'id_user' => Auth::id()
            ]);
            Session::flash('success', 'Gallery baru berhasil di tambahkan !');
            return redirect('admin/gallery/daftar-gallery');
          }
        }else{
          Session::flash('error', 'Judul gallery '.$r->judul.' sudah ada !');
          return redirect()->back()->withInput();
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function indexGallery(){
      $galleries = Gallery::all();
      return view('admin.gallery.daftar-gallery', compact('galleries'));
    }

    public function updateGallery(Request $r, $id_gallery){
      $validator = Validator::make($r->all(), [
        'judul' => 'required',
        'deskripsi' => 'required',
        'status' => 'required'
      ]);
      if (!$validator->fails()) {
        if ($r->hasFile('gambar')) {
          $gambar = $r->file('gambar');
          $filename = time() . '.' . $gambar->getClientOriginalExtension();
          Image::make($gambar)->resize(365, 280)->save(public_path('/backend/images/gallery/'.$filename));
          $gallery = Gallery::findOrFail($id_gallery)->update([
              'judul' => $r->judul,
              'slug' => str_slug($r->judul),
              'gambar' => $filename,
              'deskripsi' => $r->deskripsi,
              'status' => $r->status
          ]);
          Session::flash('success', 'Gallery berhasil diubah !');
          return redirect('admin/gallery/daftar-gallery');
        }else{
          $gallery = Gallery::findOrFail($id_gallery)->update([
              'judul' => $r->judul,
              'slug' => str_slug($r->judul),
              'deskripsi' => $r->deskripsi,
              'status' => $r->status
          ]);
          Session::flash('success', 'Gallery berhasil diubah !');
          return redirect('admin/gallery/daftar-gallery');
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }
}
