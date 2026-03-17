<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJawaban extends Model
{
    protected $table = 'user_jawaban';

    protected $fillable = ['user_id', 'soal_id', 'jawaban'];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
