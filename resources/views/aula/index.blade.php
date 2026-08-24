@extends('layouts.app')
@section('title', 'Pilih Aula')

@section('content')
    <h3 class="mb-4">Pilih Aula yang Ingin Dibooking</h3>
    <div class="row g-4">
        @foreach ($aulas as $aula)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $aula->nama }}</h5>
                        <p class="card-text text-muted mb-1">Kapasitas: {{ $aula->kapasitas ?? '-' }} orang</p>
                        <p class="card-text">{{ $aula->deskripsi ?? 'Belum ada deskripsi.' }}</p>
                        <a href="{{ route('aula.kalender', $aula->slug) }}" class="btn btn-primary w-100">
                            Lihat Ketersediaan & Booking
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
