<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = ['judul', 'deskripsi', 'kategori', 'thumbnail', 'zoom_url', 'tanggal_kegiatan'];

    public function peserta(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'kegiatan_peserta')->withTimestamps()->withPivot('tanggal_daftar');
    }
}
