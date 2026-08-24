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
}
