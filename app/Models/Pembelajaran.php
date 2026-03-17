<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelajaran extends Model
{
    protected $table = 'pembelajaran';
    
    protected $fillable = ['judul', 'deskripsi', 'kategori', 'thumbnail', 'link_video'];

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }
}
