<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKejuaraan extends Model
{
    protected $table = 'detail_kejuaraans';
    protected $fillable = [
      'id_kejuaraan',
      'ketentuan',
      'tatacara',
      'hasil_kejuaraan'
    ];

    public function kejuaraan(){
      return $this->belongsTo('App\Kejuaraan', 'id_kejuaraan');
    }
}
