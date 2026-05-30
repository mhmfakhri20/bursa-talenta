<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Dasar-Dasar Pemrograman Web',
                'deskripsi' => 'Pelajari konsep dasar HTML, CSS, dan JavaScript untuk membangun website sederhana.',
                'kategori' => 'Web Development',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Pengenalan UI/UX Design',
                'deskripsi' => 'Materi pengantar tentang desain antarmuka, pengalaman pengguna, wireframe, dan prototyping.',
                'kategori' => 'Design',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Belajar Laravel untuk Pemula',
                'deskripsi' => 'Pahami routing, controller, model, migration, dan konsep MVC pada Laravel.',
                'kategori' => 'Backend',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Dasar Database MySQL',
                'deskripsi' => 'Pelajari cara membuat tabel, relasi data, query dasar, dan pengelolaan database MySQL.',
                'kategori' => 'Database',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Public Speaking untuk Karier',
                'deskripsi' => 'Latihan komunikasi, presentasi, dan membangun rasa percaya diri di dunia kerja.',
                'kategori' => 'Soft Skill',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Persiapan Masuk Dunia Kerja',
                'deskripsi' => 'Materi tentang CV, interview, portofolio, dan strategi melamar pekerjaan.',
                'kategori' => 'Karier',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Manajemen Waktu Produktif',
                'deskripsi' => 'Pelajari cara menyusun prioritas, mengatur jadwal, dan menjaga fokus belajar.',
                'kategori' => 'Produktivitas',
                'thumbnail' => null,
            ],
            [
                'judul' => 'Dasar Analisis Data',
                'deskripsi' => 'Kenali konsep data, visualisasi sederhana, dan pengambilan keputusan berbasis data.',
                'kategori' => 'Data',
                'thumbnail' => null,
            ],
        ];

        foreach ($data as $item) {
            DB::table('pembelajaran')->updateOrInsert(
                ['judul' => $item['judul']],
                [
                    'deskripsi' => $item['deskripsi'],
                    'kategori' => $item['kategori'],
                    'thumbnail' => $item['thumbnail'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}