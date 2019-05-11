<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'beritas';
    protected $fillable = [
      'id_user', 'judul', 'slug', 'isi', 'gambar', 'status'
    ];

    public function user(){
      return $this->belongsTo('App\User', 'id_user');
    }
}
