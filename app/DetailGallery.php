<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailGallery extends Model
{
    protected $table = 'detail_galleries';
    protected $fillable = [
      'id_gallery',
      'gambar'
    ];

    public function gallery(){
      return $this->belongsTo('App\Gallery', 'id_gallery');
    }
}
