@extends('layouts.app')
@section('title', 'Ajukan Booking ' . $aula->nama)

@section('content')
    <h3 class="mb-4">Ajukan Booking — {{ $aula->nama }}</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('booking.store', $aula->slug) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}" required>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Keperluan / Nama Acara</label>
                        <input type="text" name="keperluan" class="form-control" value="{{ old('keperluan') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" class="form-control" value="{{ old('jumlah_peserta') }}" min="1">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama PIC / Penanggung Jawab</label>
                        <input type="text" name="pic_nama" class="form-control" value="{{ old('pic_nama') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. HP PIC</label>
                        <input type="text" name="pic_hp" class="form-control" value="{{ old('pic_hp') }}" required>
                    </div>
                </div>

                <div class="alert alert-info mt-3 mb-0">
                    Setelah diajukan, status booking akan <strong>pending</strong> menunggu persetujuan admin.
                    Slot jadwal ini otomatis terkunci sejak status pending, jadi tidak bisa diajukan pegawai lain
                    di jam yang sama.
                </div>

                <button class="btn btn-primary mt-3">Kirim Pengajuan</button>
            </form>
        </div>
    </div>
@endsection
