<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'rankings';
    protected $fillable = [
      'id_kategori',
      'id_atlet',
      'id_pas_atlet',
      'ranking',
      'total_main',
      'total_poin'
    ];

    public function category(){
      return $this->belongsTo('App\Category','id_kategori');
    }

    public function atlet(){
      return $this->belongsTo('App\Atlet','id_atlet');
    }

    public function atletP(){
      return $this->belongsTo('App\Atlet','id_pas_atlet');
    }
}
