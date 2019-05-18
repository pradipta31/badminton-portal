<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';
    protected $fillable = [
      'id_user',
      'judul',
      'slug',
      'gambar',
      'deskripsi',
      'status'
    ];

    public function detailGallery(){
      return $this->hasOne('App\DetailGallery');
    }

    public function user(){
      return $this->belongsTo('App\User','id_user');
    }
}
