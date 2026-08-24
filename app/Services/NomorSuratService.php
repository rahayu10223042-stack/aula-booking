<?php

namespace App\Services;

use App\Models\JenisSurat;
use App\Models\NomorUrutCounter;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NomorSuratService
{
    /**
     * Generate nomor surat baru secara atomic (aman dari race condition)
     * dan simpan record-nya di tabel surat.
     *
     * Format default: {kode_klasifikasi}/{nomor_urut}/Bapelitbangda/{bulan_romawi}/{tahun}
     * Silakan sesuaikan format ini dengan aturan kearsipan resmi di kantor.
     */
    public function buatSurat(JenisSurat $jenisSurat, User $pembuat, array $data): Surat
    {
        return DB::transaction(function () use ($jenisSurat, $pembuat, $data) {
            $tahun = now()->year;

            // lock baris counter supaya 2 proses tidak bisa ambil nomor yang sama
            $counter = NomorUrutCounter::where('kode_klasifikasi', $jenisSurat->kode_klasifikasi)
                ->where('tahun', $tahun)
                ->lockForUpdate()
                ->first();

            if (! $counter) {
                $counter = NomorUrutCounter::create([
                    'kode_klasifikasi' => $jenisSurat->kode_klasifikasi,
                    'tahun' => $tahun,
                    'last_number' => 0,
                ]);
                // lock ulang row yang baru dibuat
                $counter = NomorUrutCounter::where('id', $counter->id)->lockForUpdate()->first();
            }

            $nomorUrut = $counter->last_number + 1;
            $counter->update(['last_number' => $nomorUrut]);

            $bulanRomawi = $this->angkaKeRomawi((int) now()->month);

            $nomorSurat = sprintf(
                '%s/%d/Bapelitbangda/%s/%d',
                $jenisSurat->kode_klasifikasi,
                $nomorUrut,
                $bulanRomawi,
                $tahun
            );

            return Surat::create([
                'jenis_surat_id' => $jenisSurat->id,
                'nomor_urut' => $nomorUrut,
                'nomor_surat' => $nomorSurat,
                'tanggal_surat' => now()->toDateString(),
                'perihal' => $data['perihal'],
                'tujuan' => $data['tujuan'] ?? null,
                'keterangan' => $data['keterangan'] ?? null,
                'booking_id' => $data['booking_id'] ?? null,
                'file_pdf' => $data['file_pdf'] ?? null,
                'dibuat_oleh' => $pembuat->id,
            ]);
        });
    }

    private function angkaKeRomawi(int $bulan): string
    {
        $romawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];

        return $romawi[$bulan] ?? (string) $bulan;
    }
}
