<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    // form pengajuan booking
    public function create(Aula $aula)
    {
        return view('booking.create', compact('aula'));
    }

    // proses submit booking, INTI anti double-booking ada di sini
    public function store(Request $request, Aula $aula): RedirectResponse
    {
        $data = $request->validate([
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'keperluan' => ['required', 'string', 'max:255'],
            'jumlah_peserta' => ['nullable', 'integer', 'min:1'],
            'pic_nama' => ['required', 'string', 'max:100'],
            'pic_hp' => ['required', 'string', 'max:20'],
        ]);

        try {
            $booking = DB::transaction(function () use ($data, $aula) {
                // lock semua baris booking aula+tanggal ini dulu, biar tidak ada
                // proses submit lain yang baca data "kosong" secara bersamaan
                $bentrok = Booking::bentrokDengan(
                    $aula->id,
                    $data['tanggal'],
                    $data['jam_mulai'],
                    $data['jam_selesai']
                )->lockForUpdate()->exists();

                if ($bentrok) {
                    throw ValidationException::withMessages([
                        'jam_mulai' => 'Maaf, slot jadwal ini baru saja diambil orang lain. Silakan pilih jam lain.',
                    ]);
                }

                return Booking::create([
                    'aula_id' => $aula->id,
                    'user_id' => Auth::id(),
                    'tanggal' => $data['tanggal'],
                    'jam_mulai' => $data['jam_mulai'],
                    'jam_selesai' => $data['jam_selesai'],
                    'keperluan' => $data['keperluan'],
                    'jumlah_peserta' => $data['jumlah_peserta'] ?? null,
                    'pic_nama' => $data['pic_nama'],
                    'pic_hp' => $data['pic_hp'],
                    'status' => 'pending',
                    // auto-expire kalau admin tidak proses dalam 2 hari
                    'expires_at' => now()->addDays(2),
                ]);
            });
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        return redirect()->route('booking.history')
            ->with('success', "Pengajuan booking aula {$aula->nama} berhasil dikirim, menunggu persetujuan admin.");
    }

    // riwayat booking milik pegawai yang login
    public function history()
    {
        $bookings = Booking::with('aula', 'surat')
            ->where('user_id', Auth::id())
            ->latest('tanggal')
            ->paginate(10);

        return view('booking.history', compact('bookings'));
    }

    // pegawai batalkan booking sendiri (hanya kalau masih pending)
    public function cancel(Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === Auth::id(), 403);
        abort_unless($booking->status === 'pending', 403, 'Booking yang sudah diproses tidak bisa dibatalkan sendiri.');

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}
