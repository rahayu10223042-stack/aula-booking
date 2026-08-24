@extends('layouts.app')
@section('title', 'Catat Surat Manual')

@section('content')
    <h3 class="mb-4">Catat Surat Manual</h3>
    <p class="text-muted">Untuk jenis surat yang dibuat/diketik manual (Word, dsb) di luar sistem ini.
        Isi form ini supaya suratnya tetap tercatat resmi dan mendapat nomor urut dari sistem.</p>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.surat.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Jenis Surat</label>
                    <select name="jenis_surat_id" class="form-select" required>
                        <option value="">-- Pilih jenis surat --</option>
                        @foreach ($jenisSurat as $j)
                            <option value="{{ $j->id }}">{{ $j->nama }} ({{ $j->kode_klasifikasi }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Perihal</label>
                    <input type="text" name="perihal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tujuan / Kepada</label>
                    <input type="text" name="tujuan" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>
                <button class="btn btn-primary">Catat & Ambil Nomor Surat</button>
            </form>
        </div>
    </div>
@endsection
