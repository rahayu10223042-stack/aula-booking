<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class ExpirePendingBookings extends Command
{
    // jalan otomatis tiap hari, expire booking pending yang tidak diproses admin
    protected $signature = 'bookings:expire-pending';
    protected $description = 'Otomatis expire booking pending yang lewat batas waktu, biar slot terbuka lagi';

    public function handle(): void
    {
        $count = Booking::where('status', 'pending')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->update(['status' => 'expired']);

        $this->info("Berhasil expire {$count} booking pending.");
    }
}
