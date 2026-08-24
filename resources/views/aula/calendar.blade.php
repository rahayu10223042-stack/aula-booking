@extends('layouts.app')
@section('title', 'Kalender ' . $aula->nama)

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $aula->nama }}</h3>
        <a href="{{ route('booking.create', $aula->slug) }}" class="btn btn-success">+ Ajukan Booking</a>
    </div>

    <div class="mb-3">
        <span class="badge badge-pending">&nbsp;&nbsp;</span> Pending (menunggu approval) &nbsp;
        <span class="badge badge-approved" style="background:#dc2626;">&nbsp;&nbsp;</span> Sudah dibooking (approved)
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
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
