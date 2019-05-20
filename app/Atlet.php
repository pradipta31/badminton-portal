<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atlet extends Model
{
    protected $table = 'atlets';
    protected $fillable = [
      'id_klub',
      'kode_atlet',
      'nama',
      'tempat_lahir',
      'tgl_lahir',
      'foto',
      'status'
    ];

    public function club(){
      return $this->belongsTo('App\Club', 'id_klub');
    }
}
