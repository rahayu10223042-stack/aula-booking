@extends('layouts.booking')
@section('title', 'Riwayat Booking Saya')

@section('content')
    <div class="page-heading">
        <div>
            <div class="eyebrow">Booking Saya</div>
            <h3 class="mb-0">Riwayat Booking</h3>
        </div>
    </div>

    <div class="table-wrap">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Aula</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Surat</th>
                    <th class="pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td class="ps-4">
                            <span class="aula-dot d-inline-block" style="width:8px;height:8px;border-radius:999px;background:{{ $booking->aula->accentColor() }};margin-right:6px;"></span>
                            {{ $booking->aula->nama }}
                        </td>
                        <td>{{ $booking->tanggal->format('d M Y') }}</td>
                        <td>{{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }}</td>
                        <td>{{ $booking->keperluan }}</td>
                        <td>
                            <span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                            @if ($booking->status === 'rejected' && $booking->catatan_admin)
                                <div class="small mt-1" style="color: var(--ink-muted);">Alasan: {{ $booking->catatan_admin }}</div>
                            @endif
                        </td>
                        <td>
                            @if ($booking->surat)
                                <a href="{{ asset('storage/' . $booking->surat->file_pdf) }}" target="_blank">
                                    {{ $booking->surat->nomor_surat }}
                                </a>
                            @else
                                <span style="color: var(--ink-muted);">-</span>
                            @endif
                        </td>
                        <td class="pe-4">
                            @if ($booking->status === 'pending')
                                <form method="POST" action="{{ route('booking.cancel', $booking) }}"
                                      onsubmit="return confirm('Batalkan booking ini?')">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-danger">Batalkan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-4" style="color: var(--ink-muted);">Belum ada booking.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $bookings->links() }}</div>
@endsection
