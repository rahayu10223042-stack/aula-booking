<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = [
        'jenis_surat_id', 'nomor_urut', 'nomor_surat', 'tanggal_surat',
        'perihal', 'tujuan', 'keterangan', 'booking_id', 'file_pdf', 'dibuat_oleh',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
