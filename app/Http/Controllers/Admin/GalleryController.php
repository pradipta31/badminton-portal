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

    public function getPhoto($id_gallery){
      $gallery = Gallery::where('id',$id_gallery)->first();
      $photos = DetailGallery::where('id_gallery', $id_gallery)->get();
      return view('admin.gallery.tambah-gallery', compact('gallery','photos'));
    }

    public function tambahPhoto(Request $r){
      $validator = Validator::make($r->all(), [
        'gambar' => 'required',
        'gambar.*' => 'mimes:jpeg,jpg,png'
      ]);
      if (!$validator->fails()) {
        $gambar = $r->file('gambar');
        $filename = time() . '.' . $gambar->getClientOriginalExtension();
        Image::make($gambar)->save(public_path('/backend/images/photo/'.$filename));
        $gallery = DetailGallery::create([
            'id_gallery' => $r->id_gallery,
            'gambar' => $filename
        ]);
        Session::flash('success', 'Photo gallery berhasil ditambahkan !');
        return redirect('admin/gallery/tambah-foto/'.$r->id_gallery);
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function updatePhoto(Request $r, $id_foto){
      $validator = Validator::make($r->all(), [
        'gambar' => 'required',
        'gambar.*' => 'mimes:jpeg,jpg,png'
      ]);
      if (!$validator->fails()) {
        $gambar = $r->file('gambar');
        $filename = time() . '.' . $gambar->getClientOriginalExtension();
        Image::make($gambar)->save(public_path('/backend/images/photo/'.$filename));
        $gallery = DetailGallery::findOrFail($id_foto)->update([
            'gambar' => $filename
        ]);
        Session::flash('success', 'Photo gallery berhasil diubah !');
        return redirect('admin/gallery/tambah-foto/'.$r->id_gallery);
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function deletePhoto($id_foto){
      $id_gallery = DetailGallery::where('id', $id_foto)->first();
      $photos = DetailGallery::where('id',$id_foto)->delete();
      Session::flash('success', 'Foto yang terpilih berhasil dihapus !');
      return redirect('admin/gallery/tambah-foto/'.$id_gallery->id_gallery);
    }
}
