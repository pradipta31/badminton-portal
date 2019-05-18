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
      'batas_pendaftaran',
      'status_berkas'
    ];

    public function detailKejuaraan(){
      return $this->hasOne('App\DetailKejuaraan', 'id_kejuaraan');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($kejuaraan) {
             $kejuaraan->detailKejuaraan()->delete();
        });
    }
}
