<?php

namespace Database\Seeders;

use App\Models\Aula;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    public function run(): void
    {
        $aulas = [
            [
                'slug' => 'wiradadaha',
                'nama' => 'Aula Wiradadaha',
                'kapasitas' => 100,
                'deskripsi' => 'Aula utama Bapelitbangda, cocok untuk rapat koordinasi besar, sosialisasi program, dan acara seremonial.',
                'fasilitas' => 'Proyektor, sound system, AC, meja kursi rapat, panggung kecil',
            ],
            [
                'slug' => 'wiratanuningrat',
                'nama' => 'Aula Wiratanuningrat',
                'kapasitas' => 80,
                'deskripsi' => 'Ruang serbaguna untuk rapat lintas bidang, FGD, dan pelatihan internal.',
                'fasilitas' => 'Proyektor, sound system, AC, whiteboard',
            ],
            [
                'slug' => 'wirahadiningrat',
                'nama' => 'Aula Wirahadiningrat',
                'kapasitas' => 60,
                'deskripsi' => 'Ruang lebih kecil dan intim, ideal untuk rapat internal bidang atau diskusi terbatas.',
                'fasilitas' => 'Proyektor, AC, meja kursi rapat',
            ],
        ];

        foreach ($aulas as $aula) {
            Aula::updateOrCreate(['slug' => $aula['slug']], $aula);
        }
    }
}