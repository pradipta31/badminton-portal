<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atlet extends Model
{
    protected $table = 'atlets';
    protected $fillable = [
      'kode_atlet',
      'nama',
      'tempat_lahir',
      'tgl_lahir',
      'klub',
      'cabang',
      'foto',
      'status'
    ];
}
