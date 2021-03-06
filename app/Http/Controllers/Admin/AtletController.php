<?php

namespace App\Http\Controllers\Admin;

use Image;
use Session;
use Validator;
use App\Atlet;
use App\Club;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AtletController extends Controller
{
    public function tambahAtlet(){
      $clubs = Club::where('status','=','aktif')->get();
      return view('admin.atlet.tambah-atlet', compact('clubs'));
    }

    public function simpanAtlet(Request $r){
      $validator = Validator::make($r->all(), [
        'id_klub' => 'required',
        'kode_atlet' => 'required',
        'nama' => 'required',
        'tempat_lahir' => 'required',
        'tgl_lahir' => 'required',
      ]);

      if (!$validator->fails()) {
        if ($r->file('foto') != null) {
          $check_atlet = Atlet::where('kode_atlet','=', $r->kode_atlet)->first();
          if ($check_atlet == null) {
            $foto = $r->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            if ($r->file('foto')->isValid()) {
              Image::make($foto)->resize(365, 280)->save(public_path('/backend/images/atlet/'.$filename));
              $atlet = Atlet::create([
                'id_klub' => $r->id_klub,
                'kode_atlet' => $r->kode_atlet,
                'nama' => $r->nama,
                'tempat_lahir' => $r->tempat_lahir,
                'tgl_lahir' => $r->tgl_lahir,
                'foto' => $filename,
                'status' => 'aktif'
              ]);
            }
            Session::flash('success', 'Atlet baru berhasil di tambahkan !');
            return redirect('admin/atlet/data-atlet');
          }else{
            Session::flash('error', 'Atlet '.$r->kode_atlet.' sudah ada !');
            return redirect()->back()->withInput();
          }
        }else{
          $check_atlet = Atlet::where('kode_atlet','=', $r->kode_atlet)->first();
          if ($check_atlet == null) {
            $atlet = Atlet::create([
              'id_klub' => $r->id_klub,
              'kode_atlet' => $r->kode_atlet,
              'nama' => $r->nama,
              'tempat_lahir' => $r->tempat_lahir,
              'tgl_lahir' => $r->tgl_lahir,
              'status' => 'aktif'
            ]);
            Session::flash('success', 'Atlet baru berhasil di tambahkan !');
            return redirect('admin/atlet/data-atlet');
          }else{
            Session::flash('error', 'Atlet '.$r->kode_atlet.' sudah ada !');
            return redirect()->back()->withInput();
          }
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function indexAtlet(){
      $atlets = Atlet::all();
      return view('admin.atlet.data-atlet', compact('atlets'));
    }

    public function editAtlet($id_atlet){
      $clubs = Club::where('status','=','aktif')->get();
      $atlet = Atlet::where('id','=',$id_atlet)->first();
      return view('admin.atlet.edit-atlet', compact('atlet', 'clubs'));
    }

    public function updateAtlet(Request $r, $id_atlet){
      $validator = Validator::make($r->all(), [
        'id_klub' => 'required',
        'kode_atlet' => 'required',
        'nama' => 'required',
        'tempat_lahir' => 'required',
        'tgl_lahir' => 'required'
      ]);

      if (!$validator->fails()) {
        if ($r->file('foto') != null) {
          $foto = $r->file('foto');
          $filename = time() . '.' . $foto->getClientOriginalExtension();
          if ($r->file('foto')->isValid()) {
            Image::make($foto)->resize(365, 280)->save(public_path('/backend/images/atlet/'.$filename));
            $atlet = Atlet::findOrFail($id_atlet)->update([
              'id_klub' => $r->id_klub,
              'kode_atlet' => $r->kode_atlet,
              'nama' => $r->nama,
              'tempat_lahir' => $r->tempat_lahir,
              'tgl_lahir' => $r->tgl_lahir,
              'foto' => $filename,
              'status' => 'aktif'
            ]);
          }
          Session::flash('success', 'Data atlet berhasil di ubah !');
          return redirect('admin/atlet/data-atlet');
        }else{
          $atlet = Atlet::findOrFail($id_atlet)->update([
            'id_klub' => $r->id_klub,
            'kode_atlet' => $r->kode_atlet,
            'nama' => $r->nama,
            'tempat_lahir' => $r->tempat_lahir,
            'tgl_lahir' => $r->tgl_lahir,
            'status' => 'aktif'
          ]);
          Session::flash('success', 'Data atlet berhasil di ubah !');
          return redirect('admin/atlet/data-atlet');
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function deleteAtlet($id_atlet){
      $atlet = Atlet::where('id',$id_atlet)->delete();
      Session::flash('success', 'Atlet yang terpilih berhasil dihapus !');
      return redirect('admin/atlet/data-atlet');
    }
}
