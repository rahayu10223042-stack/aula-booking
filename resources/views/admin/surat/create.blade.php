@extends('layouts.booking')
@section('title', 'Catat Surat Manual')

@section('content')
    <div class="page-heading">
        <div>
            <div class="eyebrow">Admin</div>
            <h3 class="mb-0">Catat Surat Manual</h3>
        </div>
    </div>
    <p style="color: var(--ink-muted);" class="mb-4">Untuk jenis surat yang dibuat/diketik manual (Word, dsb) di luar sistem ini.
        Isi form ini supaya suratnya tetap tercatat resmi dan mendapat nomor urut dari sistem.</p>

    <div class="card">
        <div class="card-body p-4">
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
                <button class="btn btn-primary">Catat &amp; Ambil Nomor Surat</button>
            </form>
        </div>
    </div>
@endsection
