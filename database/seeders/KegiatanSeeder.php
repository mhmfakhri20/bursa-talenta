<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Workshop Laravel Dasar',
                'deskripsi' => 'Kegiatan pelatihan Laravel untuk memahami routing, controller, model, dan database.',
                'kategori' => 'Workshop',
                'thumbnail' => null,
                'tanggal_kegiatan' => '2026-06-10',
            ],
            [
                'judul' => 'Seminar Persiapan Karier Digital',
                'deskripsi' => 'Seminar tentang peluang kerja digital, portofolio, CV, dan strategi interview.',
                'kategori' => 'Seminar',
                'thumbnail' => null,
                'tanggal_kegiatan' => '2026-06-15',
            ],
            [
                'judul' => 'Bootcamp UI/UX Design',
                'deskripsi' => 'Bootcamp singkat untuk belajar user research, wireframe, dan desain prototype.',
                'kategori' => 'Bootcamp',
                'thumbnail' => null,
                'tanggal_kegiatan' => '2026-06-20',
            ],
            [
                'judul' => 'Pelatihan Database MySQL',
                'deskripsi' => 'Pelatihan query SQL, relasi tabel, dan pengelolaan database untuk aplikasi web.',
                'kategori' => 'Pelatihan',
                'thumbnail' => null,
                'tanggal_kegiatan' => '2026-06-25',
            ],
            [
                'judul' => 'Kelas Public Speaking',
                'deskripsi' => 'Kelas praktik komunikasi dan presentasi untuk meningkatkan kepercayaan diri.',
                'kategori' => 'Soft Skill',
                'thumbnail' => null,
                'tanggal_kegiatan' => '2026-07-01',
            ],
            [
                'judul' => 'Webinar Data Analyst Pemula',
                'deskripsi' => 'Webinar pengenalan data analyst, tools dasar, dan contoh studi kasus sederhana.',
                'kategori' => 'Webinar',
                'thumbnail' => null,
                'tanggal_kegiatan' => '2026-07-05',
            ],
        ];

        foreach ($data as $item) {
            DB::table('kegiatan')->updateOrInsert(
                ['judul' => $item['judul']],
                [
                    'deskripsi' => $item['deskripsi'],
                    'kategori' => $item['kategori'],
                    'thumbnail' => $item['thumbnail'],
                    'tanggal_kegiatan' => $item['tanggal_kegiatan'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}