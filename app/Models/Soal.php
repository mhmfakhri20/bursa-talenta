<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';

    protected $fillable = ['pembelajaran_id', 'pertanyaan', 'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'jawaban_benar'];

    public function pembelajaran()
    {
        return $this->belongsTo(Pembelajaran::class);
    }

    public function jawaban()
    {
        return $this->hasMany(UserJawaban::class);
    }
}
