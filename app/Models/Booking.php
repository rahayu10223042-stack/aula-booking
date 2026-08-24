<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'aula_id', 'user_id', 'tanggal', 'jam_mulai', 'jam_selesai',
        'keperluan', 'jumlah_peserta', 'pic_nama', 'pic_hp',
        'status', 'catatan_admin', 'expires_at',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'expires_at' => 'datetime',
    ];

    // status yang dianggap "mengunci" slot jadwal (pending & approved)
    public const STATUS_MENGUNCI_SLOT = ['pending', 'approved'];

    public function aula(): BelongsTo
    {
        return $this->belongsTo(Aula::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function surat(): HasOne
    {
        return $this->hasOne(Surat::class);
    }

    /**
     * Scope query untuk cari booking yang bentrok jadwal
     * dengan aula, tanggal, dan rentang jam tertentu.
     */
    public function scopeBentrokDengan($query, int $aulaId, string $tanggal, string $jamMulai, string $jamSelesai, ?int $kecualiBookingId = null)
    {
        return $query->where('aula_id', $aulaId)
            ->where('tanggal', $tanggal)
            ->whereIn('status', self::STATUS_MENGUNCI_SLOT)
            ->when($kecualiBookingId, fn ($q) => $q->where('id', '!=', $kecualiBookingId))
            ->where(function ($q) use ($jamMulai, $jamSelesai) {
                // overlap klasik: mulai_baru < selesai_lama DAN selesai_baru > mulai_lama
                $q->where('jam_mulai', '<', $jamSelesai)
                  ->where('jam_selesai', '>', $jamMulai);
            });
    }
}
