@extends('layouts.booking')
@section('title', 'Kalender ' . $aula->nama)

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<style>
    .fc { --fc-border-color: #E7EAF2; --fc-today-bg-color: rgba(79,70,229,0.06); font-family: 'Inter', sans-serif; }
    .fc .fc-toolbar-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 1.15rem; }
    .fc .fc-button-primary { background: var(--indigo); border-color: var(--indigo); border-radius: 8px; }
    .fc .fc-button-primary:hover { background: #4338CA; }
    .aula-dot { display: inline-block; width: 10px; height: 10px; border-radius: 999px; margin-right: 6px; }
</style>
@endpush

@section('content')
    <div class="page-heading justify-content-between" style="display:flex; align-items:center;">
        <div>
            <div class="eyebrow" style="display:flex; align-items:center;">
                <span class="aula-dot" style="background: {{ $aula->accentColor() }};"></span> Kalender Ketersediaan
            </div>
            <h3 class="mb-0">{{ $aula->nama }}</h3>
        </div>
        <a href="{{ route('booking.create', $aula->slug) }}" class="btn btn-primary">+ Ajukan Booking</a>
    </div>

    <div class="mb-3" style="font-size: 0.88rem; color: var(--ink-muted);">
        <span class="badge badge-pending">&nbsp;&nbsp;</span> Pending (menunggu approval) &nbsp;&nbsp;
        <span class="aula-dot" style="background: {{ $aula->accentColor() }};"></span> Sudah dibooking (approved)
    </div>

    <div class="card">
        <div class="card-body p-4">
            <div id="calendar"></div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            height: 650,
            events: "{{ route('aula.jadwal.json', $aula->slug) }}",
        });
        calendar.render();
    });
</script>
@endpush
