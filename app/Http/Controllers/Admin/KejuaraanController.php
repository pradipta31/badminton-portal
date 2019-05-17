<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use Validator;
use App\Kejuaraan;
use App\DetailKejuaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KejuaraanController extends Controller
{
    public function tambahKejuaraan(){
      return view('admin.kejuaraan.tambah-kejuaraan');
    }

    public function simpanKejuaraan(Request $r){
      $validator = Validator::make($r->all(),[
        'nama_kejuaraan' => 'required',
        'kategori' => 'required',
        'tgl_akhir' => 'required',
        'kabupaten' => 'required'
      ]);

      if (!$validator->fails()) {
        $cek_kejuaraan = Kejuaraan::where('nama_kejuaraan','=',$r->nama_kejuaraan)->first();
        if ($cek_kejuaraan == null) {
          $kejuaraans = Kejuaraan::create([
            'nama_kejuaraan' => $r->nama_kejuaraan,
            'kategori' => $r->kategori,
            'kabupaten' => $r->kabupaten,
            'tgl_mulai' => $r->tgl_mulai,
            'tgl_akhir' => $r->tgl_akhir,
            'hadiah' => $r->hadiah,
            'batas_pendaftaran' => $r->batas_pendaftaran
          ]);
          Session::flash('success', 'Kejuaraan baru berhasil di tambahkan !');
          return redirect('admin/kejuaraan/daftar-kejuaraan');
        }else{
          Session::flash('error', 'Kejuaraan '.$r->nama_kejuaraan.' sudah ada !');
          return redirect()->back()->withInput();
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function indexKejuaraan(){
      $kejuaraans = Kejuaraan::all();
      return view('admin.kejuaraan.daftar-kejuaraan', compact('kejuaraans'));
    }

    public function updateKejuaraan(Request $r, $id_kejuaraan){
      $validator = Validator::make($r->all(),[
        'nama_kejuaraan' => 'required',
        'kategori' => 'required',
        'tgl_akhir' => 'required',
        'kabupaten' => 'required'
      ]);

      if (!$validator->fails()) {
        $kejuaraans = Kejuaraan::findOrFail($id_kejuaraan)->update([
          'nama_kejuaraan' => $r->nama_kejuaraan,
          'kategori' => $r->kategori,
          'kabupaten' => $r->kabupaten,
          'tgl_mulai' => $r->tgl_mulai,
          'tgl_akhir' => $r->tgl_akhir,
          'hadiah' => $r->hadiah,
          'batas_pendaftaran' => $r->batas_pendaftaran
        ]);
        Session::flash('success', 'Kejuaraan baru berhasil di tambahkan !');
        return redirect('admin/kejuaraan/daftar-kejuaraan');
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function deleteKejuaraan($id_kejuaraan){

    }
}
