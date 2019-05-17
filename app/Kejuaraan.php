<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kejuaraan extends Model
{
    protected $table = 'kejuaraans';
    protected $fillable = [
      'nama_kejuaraan',
      'kategori',
      'kabupaten',
      'tgl_mulai',
      'tgl_akhir',
      'hadiah',
      'batas_pendaftaran'
    ];

    public function detailKejuaraan(){
      return $this->hasOne('App\DetailKejuaraan');
    }
}
