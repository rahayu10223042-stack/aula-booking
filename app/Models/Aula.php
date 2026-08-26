<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'nama', 'kapasitas', 'fasilitas', 'foto', 'deskripsi', 'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Warna identitas tiap aula, dipakai konsisten di kartu, kalender, dan badge
     * supaya pegawai bisa langsung kenali aula dari warnanya di seluruh aplikasi.
     */
    public function accentColor(): string
    {
        return match ($this->slug) {
            'wiradadaha' => '#4F46E5',        // indigo
            'wiratanuningrat' => '#0D9488',   // teal
            'wirahadiningrat' => '#CA8A04',   // gold
            default => '#64748B',             // slate (fallback)
        };
    }
}
