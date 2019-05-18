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
            'batas_pendaftaran' => $r->batas_pendaftaran,
            'status_berkas' => 'belum'
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

    public function simpanDocument(Request $r, $id_kejuaraan){
      $validator = Validator::make($r->all(), [
        'ketentuan' => 'required|file',
        'tatacara' => 'required|file'
      ]);

      if (!$validator->fails()) {
        // Ketentuan File
        $ketentuan = $r->file('ketentuan');
        $file_ketentuan = time().'.'.$ketentuan->getClientOriginalExtension();
        $path_ketentuan = 'backend/ketentuan';
        $ketentuan->storeAs($path_ketentuan,$file_ketentuan,'public');
        // Tatacara File
        $tatacara = $r->file('tatacara');
        $file_tatacara = time().'.'.$tatacara->getClientOriginalExtension();
        $path_tatacara = 'backend/tatacara';
        $tatacara->storeAs($path_tatacara,$file_tatacara,'public');

        if ($r->hasFile('hasil_kejuaraan')) {
          // Hasil Kejuaraan File
          $hasil = $r->file('hasil_kejuaraan');
          $file_hasil = time().'.'.$hasil->getClientOriginalExtension();
          $path_hasil = 'backend/hasil';
          $hasil->storeAs($path_hasil,$file_hasil,'public');
          if ($r->file('ketentuan')->isValid() && $r->file('tatacara')->isValid()) {
            $documents = DetailKejuaraan::create([
              'id_kejuaraan' => $id_kejuaraan,
              'ketentuan' => $file_ketentuan,
              'tatacara' => $file_tatacara,
              'hasil_kejuaraan' => $file_hasil
            ]);

            $status_berkas = Kejuaraan::where('id',$id_kejuaraan)->update([
              'status_berkas' => 'sudah'
            ]);
            Session::flash('success', 'Kejuaraan baru berhasil di tambahkan !');
            return redirect('admin/kejuaraan/daftar-kejuaraan');
          }
        }else{
          if ($r->file('ketentuan')->isValid() && $r->file('tatacara')->isValid()) {
            $documents = DetailKejuaraan::create([
              'id_kejuaraan' => $id_kejuaraan,
              'ketentuan' => $file_ketentuan,
              'tatacara' => $file_tatacara
            ]);
            $status_berkas = Kejuaraan::where('id',$id_kejuaraan)->update([
              'status_berkas' => 'sudah'
            ]);
            Session::flash('success', 'Kejuaraan baru berhasil di tambahkan !');
            return redirect('admin/kejuaraan/daftar-kejuaraan');
          }
        }
      }else{
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    public function getBerkas($id_kejuaraan){
      $berkas = DetailKejuaraan::where('id_kejuaraan','=',$id_kejuaraan)->first();
      return view('admin.kejuaraan.berkas-kejuaraan', compact('berkas'));
    }

    public function updateBerkas(Request $r, $id_kejuaraan){
      if ($r->hasFile('ketentuan')) {
        $ketentuan = $r->file('ketentuan');
        $file_ketentuan = time().'.'.$ketentuan->getClientOriginalExtension();
        $path_ketentuan = 'backend/ketentuan';
        $ketentuan->storeAs($path_ketentuan,$file_ketentuan,'public');
        $documents = DetailKejuaraan::findOrFail($id_kejuaraan)->update([
          'ketentuan' => $file_ketentuan
        ]);
        Session::flash('success', 'Berkas kejuaraan berhasil diubah!');
        return redirect('admin/kejuaraan/daftar-kejuaraan');
      }elseif($r->hasFile('tatacara')){
        $tatacara = $r->file('tatacara');
        $file_tatacara = time().'.'.$tatacara->getClientOriginalExtension();
        $path_tatacara = 'backend/tatacara';
        $tatacara->storeAs($path_tatacara,$file_tatacara,'public');
        $documents = DetailKejuaraan::findOrFail($id_kejuaraan)->update([
          'tatacara' => $file_tatacara
        ]);
        Session::flash('success', 'Berkas kejuaraan berhasil diubah !');
        return redirect('admin/kejuaraan/daftar-kejuaraan');
      }elseif($r->hasFile('hasil_kejuaraan')){
        $hasil = $r->file('hasil_kejuaraan');
        $file_hasil = time().'.'.$hasil->getClientOriginalExtension();
        $path_hasil = 'backend/hasil';
        $hasil->storeAs($path_hasil,$file_hasil,'public');
        $documents = DetailKejuaraan::findOrFail($id_kejuaraan)->update([
          'hasil_kejuaraan' => $file_hasil
        ]);
        Session::flash('success', 'Berkas kejuaraan berhasil diubah!');
        return redirect('admin/kejuaraan/daftar-kejuaraan');
      }
    }

    public function downloadKetentuan($get_ketentuan){
      return response()->download(base_path('storage/app/public/backend/ketentuan/'.$get_ketentuan));
    }

    public function downloadTatacara($get_tatacara){
      return response()->download(base_path('storage/app/public/backend/tatacara/'.$get_tatacara));
    }

    public function downloadHasil($get_hasil){
      return response()->download(base_path('storage/app/public/backend/hasil/'.$get_hasil));
    }

    public function deleteKejuaraan($id_kejuaraan){
      $periode = Kejuaraan::findOrFail($id_kejuaraan)->delete();
      Session::flash('success', 'Data kejuaraan berhasil dihapus!');
      return redirect('admin/kejuaraan/daftar-kejuaraan');
    }
}
