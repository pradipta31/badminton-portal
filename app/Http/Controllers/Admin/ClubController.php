<?php

namespace App\Http\Controllers\Admin;

use Session;
use Validator;
use App\Club;
use App\Atlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClubController extends Controller
{
    public function getClub(){
      $clubs = Club::all();
      return view('admin.atlet.daftar-klub', compact('clubs'));
    }

    public function simpanClub(Request $r){
      $validator = Validator::make($r->all(),[
        'nama_klub' => 'required',
        'alamat' => 'required'
      ]);

      if (!$validator->fails()) {
        $check = Club::where('nama_klub','=',$r->nama_klub)->first();
        if ($check == null) {
          $clubs = Club::create([
            'nama_klub' => $r->nama_klub,
            'alamat' => $r->alamat
          ]);
          Session::flash('success', 'Klub baru berhasil di tambahkan !');
          return redirect('admin/klub/data-klub');
        }else{
          Session::flash('error', 'Klub '.$r->nama_klub.' sudah ada !');
          return redirect()->back()->withInput();
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function updateClub(Request $r, $id_klub){
      $validator = Validator::make($r->all(),[
        'nama_klub' => 'required',
        'alamat' => 'required',
        'status' => 'required'
      ]);

      if (!$validator->fails()) {
        $clubs = Club::findOrFail($id_klub)->update([
          'nama_klub' => $r->nama_klub,
          'alamat' => $r->alamat,
          'status' => $r->status
        ]);

        $atlets = Atlet::where('id_klub', $id_klub)->update([
          'status' => $r->status
        ]);
        Session::flash('success', 'Klub berhasil diupdate !');
        return redirect('admin/klub/data-klub');
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function deleteClub($id_klub){
      $clubs = Club::where('id',$id_klub)->delete();
      Session::flash('success', 'Klub yang terpilih berhasil dihapus !');
      return redirect('admin/klub/data-klub');
    }
}
