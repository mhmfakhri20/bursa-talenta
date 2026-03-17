<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kegiatanDiikuti()
    {
        return $this->belongsToMany(Kegiatan::class, 'kegiatan_peserta')->withTimestamps()->withPivot('tanggal_daftar');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function jawaban()
    {
        return $this->hasMany(UserJawaban::class);
    }

    public function pembelajaranDiikuti()
    {
        return Pembelajaran::whereHas('soal.jawaban', function ($query) {
            $query->where('user_id', $this->id);
        })->get();
    }
}
