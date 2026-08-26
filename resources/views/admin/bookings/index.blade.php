@extends('layouts.booking')
@section('title', 'Kelola Booking')

@section('content')
    <div class="page-heading">
        <div>
            <div class="eyebrow">Admin</div>
            <h3 class="mb-0">Kelola Pengajuan Booking</h3>
        </div>
    </div>

    <div class="mb-3">
        <a href="{{ route('admin.booking.index') }}" class="btn btn-sm btn-outline-secondary">Semua</a>
        <a href="{{ route('admin.booking.index', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning">Pending</a>
        <a href="{{ route('admin.booking.index', ['status' => 'approved']) }}" class="btn btn-sm btn-outline-success">Approved</a>
    </div>

    <div class="table-wrap">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Aula</th>
                    <th>Pemohon</th>
                    <th>Tanggal / Jam</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th class="pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td class="ps-4">
                            <span class="d-inline-block" style="width:8px;height:8px;border-radius:999px;background:{{ $booking->aula->accentColor() }};margin-right:6px;"></span>
                            {{ $booking->aula->nama }}
                        </td>
                        <td>{{ $booking->user->name }}<br><small style="color: var(--ink-muted);">{{ $booking->pic_hp }}</small></td>
                        <td>{{ $booking->tanggal->format('d M Y') }}<br>{{ substr($booking->jam_mulai,0,5) }}-{{ substr($booking->jam_selesai,0,5) }}</td>
                        <td>{{ $booking->keperluan }} ({{ $booking->jumlah_peserta ?? '-' }} org)</td>
                        <td><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                        <td class="pe-4">
                            @if ($booking->status === 'pending')
                                <form method="POST" action="{{ route('admin.booking.approve', $booking) }}" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-success">Setujui</button>
                                </form>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#reject{{ $booking->id }}">Tolak</button>

                                <div class="modal fade" id="reject{{ $booking->id }}">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('admin.booking.reject', $booking) }}" class="modal-content">
                                            @csrf @method('PATCH')
                                            <div class="modal-body">
                                                <label class="form-label">Alasan penolakan</label>
                                                <textarea name="catatan_admin" class="form-control" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-outline-danger">Tolak Booking</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4" style="color: var(--ink-muted);">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $bookings->links() }}</div>
@endsection
