@extends('layouts.booking')
@section('title', 'Buku Agenda Surat')

@section('content')
    <div class="page-heading justify-content-between" style="display:flex; align-items:center;">
        <div>
            <div class="eyebrow">Admin</div>
            <h3 class="mb-0">Buku Agenda Surat Keluar</h3>
        </div>
        <a href="{{ route('admin.surat.create') }}" class="btn btn-primary">+ Catat Surat Manual</a>
    </div>

    <div class="table-wrap">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Nomor Surat</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Perihal</th>
                    <th>Tujuan</th>
                    <th>Dibuat Oleh</th>
                    <th class="pe-4">File</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($surat as $s)
                    <tr>
                        <td class="ps-4">{{ $s->nomor_surat }}</td>
                        <td>{{ $s->jenisSurat->nama }}</td>
                        <td>{{ $s->tanggal_surat->format('d M Y') }}</td>
                        <td>{{ $s->perihal }}</td>
                        <td>{{ $s->tujuan ?? '-' }}</td>
                        <td>{{ $s->pembuat->name }}</td>
                        <td class="pe-4">
                            @if ($s->file_pdf)
                                <a href="{{ asset('storage/' . $s->file_pdf) }}" target="_blank">Lihat PDF</a>
                            @else
                                <span style="color: var(--ink-muted);">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-4" style="color: var(--ink-muted);">Belum ada surat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $surat->links() }}</div>
@endsection
