<?php

namespace Database\Seeders;

use App\Models\Aula;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    public function run(): void
    {
        $aulas = [
            ['slug' => 'wiradadaha', 'nama' => 'Aula Wiradadaha', 'kapasitas' => 100],
            ['slug' => 'wiratanuningrat', 'nama' => 'Aula Wiratanuningrat', 'kapasitas' => 80],
            ['slug' => 'wirahadiningrat', 'nama' => 'Aula Wirahadiningrat', 'kapasitas' => 60],
        ];

        foreach ($aulas as $aula) {
            Aula::firstOrCreate(['slug' => $aula['slug']], $aula);
        }
    }
}
