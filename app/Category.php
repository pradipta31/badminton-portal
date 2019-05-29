<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
      'kode_kategori',
      'kategori',
      'deskripsi'
    ];

    public function ranking(){
      return $this->hasOne('App\Ranking');
    }
}
