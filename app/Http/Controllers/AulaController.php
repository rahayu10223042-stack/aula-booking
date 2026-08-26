<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Booking;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    // daftar aula (halaman pilih aula)
    public function index()
    {
        $aulas = Aula::where('aktif', true)->get();

        return view('aula.index', compact('aulas'));
    }

    // halaman kalender ketersediaan per aula
    public function kalender(Aula $aula)
    {
        return view('aula.calendar', compact('aula'));
    }

    // endpoint JSON buat FullCalendar: ambil jadwal terpakai bulan tertentu
    public function jadwalJson(Aula $aula, Request $request)
    {
        $bookings = Booking::where('aula_id', $aula->id)
            ->whereIn('status', Booking::STATUS_MENGUNCI_SLOT)
            ->get();

        $events = $bookings->map(function (Booking $b) use ($aula) {
            return [
                'title' => $b->status === 'pending' ? 'Pending' : 'Terpakai',
                'start' => $b->tanggal->format('Y-m-d') . 'T' . $b->jam_mulai,
                'end' => $b->tanggal->format('Y-m-d') . 'T' . $b->jam_selesai,
                'color' => $b->status === 'pending' ? '#F59E0B' : $aula->accentColor(),
            ];
        });

        return response()->json($events);
    }
}
