@extends('layouts.app')
@section('title', 'Buku Agenda Surat')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Buku Agenda Surat Keluar</h3>
        <a href="{{ route('admin.surat.create') }}" class="btn btn-success">+ Catat Surat Manual</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Nomor Surat</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Perihal</th>
                    <th>Tujuan</th>
                    <th>Dibuat Oleh</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($surat as $s)
                    <tr>
                        <td>{{ $s->nomor_surat }}</td>
                        <td>{{ $s->jenisSurat->nama }}</td>
                        <td>{{ $s->tanggal_surat->format('d M Y') }}</td>
                        <td>{{ $s->perihal }}</td>
                        <td>{{ $s->tujuan ?? '-' }}</td>
                        <td>{{ $s->pembuat->name }}</td>
                        <td>
                            @if ($s->file_pdf)
                                <a href="{{ asset('storage/' . $s->file_pdf) }}" target="_blank">Lihat PDF</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted">Belum ada surat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $surat->links() }}
@endsection
