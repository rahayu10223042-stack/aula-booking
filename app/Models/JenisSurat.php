<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';

    protected $fillable = ['nama', 'kode_klasifikasi', 'generate_pdf_otomatis'];

    protected $casts = [
        'generate_pdf_otomatis' => 'boolean',
    ];

    public function surat(): HasMany
    {
        return $this->hasMany(Surat::class);
    }
}
