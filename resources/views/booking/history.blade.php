@extends('layouts.app')
@section('title', 'Riwayat Booking Saya')

@section('content')
    <h3 class="mb-4">Riwayat Booking Saya</h3>

    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Aula</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Surat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->aula->nama }}</td>
                        <td>{{ $booking->tanggal->format('d M Y') }}</td>
                        <td>{{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }}</td>
                        <td>{{ $booking->keperluan }}</td>
                        <td>
                            <span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                            @if ($booking->status === 'rejected' && $booking->catatan_admin)
                                <div class="small text-muted mt-1">Alasan: {{ $booking->catatan_admin }}</div>
                            @endif
                        </td>
                        <td>
                            @if ($booking->surat)
                                <a href="{{ asset('storage/' . $booking->surat->file_pdf) }}" target="_blank">
                                    {{ $booking->surat->nomor_surat }}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
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
                    <tr><td colspan="7" class="text-center text-muted">Belum ada booking.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $bookings->links() }}
@endsection
