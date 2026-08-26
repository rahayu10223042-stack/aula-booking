@extends('layouts.booking')
@section('title', 'Pilih Aula')

@push('styles')
<style>
    .aula-hero {
        height: 108px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .aula-hero svg { width: 46px; height: 46px; opacity: 0.92; }
    .aula-hero::after {
        content: "";
        position: absolute; inset: 0;
        background: radial-gradient(circle at 85% 15%, rgba(255,255,255,0.25), transparent 55%);
    }
    .facility-chip {
        display: inline-block;
        font-size: 0.76rem;
        font-weight: 500;
        padding: 0.25em 0.65em;
        border-radius: 999px;
        background: var(--bg);
        color: var(--ink-muted);
        margin: 0 4px 4px 0;
    }
    .capacity-pill {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.85rem; font-weight: 600; color: var(--ink);
        background: var(--bg); border-radius: 999px; padding: 3px 10px 3px 8px;
    }
</style>
@endpush

@section('content')
    <div class="page-heading">
        <div>
            <div class="eyebrow">Booking Aula</div>
            <h3 class="mb-0">Pilih Aula yang Ingin Dibooking</h3>
        </div>
    </div>

    <div class="row g-4">
        @foreach ($aulas as $aula)
            @php $c = $aula->accentColor(); @endphp
            <div class="col-md-4">
                <div class="card h-100 card-hover overflow-hidden">
                    <div class="aula-hero" style="background: linear-gradient(135deg, {{ $c }}, {{ $c }}CC);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 21V8l8-5 8 5v13"/>
                            <path d="M9 21V12h6v9"/>
                            <path d="M4 21h16"/>
                        </svg>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title mb-2">{{ $aula->nama }}</h5>

                        <span class="capacity-pill mb-3">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            {{ $aula->kapasitas ?? '-' }} orang
                        </span>

                        <p class="card-text mb-3" style="font-size: 0.92rem;">
                            {{ $aula->deskripsi ?? 'Belum ada deskripsi.' }}
                        </p>

                        @if ($aula->fasilitas)
                            <div class="mb-3">
                                @foreach (explode(',', $aula->fasilitas) as $fasilitas)
                                    <span class="facility-chip">{{ trim($fasilitas) }}</span>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('aula.kalender', $aula->slug) }}" class="btn btn-primary w-100 mt-1">
                            Lihat Ketersediaan &amp; Booking
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection