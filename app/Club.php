<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $table = 'clubs';
    protected $fillable = [
      'nama_klub',
      'alamat',
      'status'
    ];

    public function atlet(){
      return $this->hasOne('App\Atlet');
    }
}
