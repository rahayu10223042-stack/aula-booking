<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        $jenis = [
            ['nama' => 'Peminjaman Aula', 'kode_klasifikasi' => '005', 'generate_pdf_otomatis' => true],
            ['nama' => 'Undangan', 'kode_klasifikasi' => '005', 'generate_pdf_otomatis' => false],
            ['nama' => 'Nota Dinas', 'kode_klasifikasi' => '800', 'generate_pdf_otomatis' => false],
            ['nama' => 'Surat Keputusan', 'kode_klasifikasi' => '900', 'generate_pdf_otomatis' => false],
        ];

        foreach ($jenis as $j) {
            JenisSurat::firstOrCreate(['nama' => $j['nama']], $j);
        }
    }
}
