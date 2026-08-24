<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\JenisSurat;
use App\Services\NomorSuratService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with('aula', 'user')
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest('tanggal')
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    // approve booking -> otomatis bikin nomor surat + PDF
    public function approve(Booking $booking, NomorSuratService $nomorSuratService): RedirectResponse
    {
        abort_unless($booking->status === 'pending', 400, 'Booking ini sudah diproses sebelumnya.');

        DB::transaction(function () use ($booking, $nomorSuratService) {
            $booking->update(['status' => 'approved', 'catatan_admin' => null]);

            $jenisSurat = JenisSurat::firstOrCreate(
                ['nama' => 'Peminjaman Aula'],
                ['kode_klasifikasi' => '005', 'generate_pdf_otomatis' => true]
            );

            $surat = $nomorSuratService->buatSurat($jenisSurat, Auth::user(), [
                'perihal' => 'Peminjaman ' . $booking->aula->nama,
                'tujuan' => $booking->pic_nama,
                'booking_id' => $booking->id,
            ]);

            // generate PDF surat pakai dompdf (pastikan package barryvdh/laravel-dompdf sudah di-install)
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('surat.template', [
                'booking' => $booking->fresh('aula', 'user'),
                'surat' => $surat,
            ]);

            $filename = 'surat/' . str_replace('/', '-', $surat->nomor_surat) . '.pdf';
            \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $pdf->output());

            $surat->update(['file_pdf' => $filename]);
        });

        return back()->with('success', 'Booking disetujui, nomor surat & PDF berhasil dibuat.');
    }

    public function reject(Request $request, Booking $booking): RedirectResponse
    {
        abort_unless($booking->status === 'pending', 400, 'Booking ini sudah diproses sebelumnya.');

        $request->validate(['catatan_admin' => ['required', 'string', 'max:500']]);

        $booking->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return back()->with('success', 'Booking ditolak.');
    }
}
