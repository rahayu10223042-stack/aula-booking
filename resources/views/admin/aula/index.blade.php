@extends('layouts.app')
@section('title', 'Kelola Aula')

@section('content')
    <h3 class="mb-4">Kelola Data Aula</h3>

    @foreach ($aulas as $aula)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5>{{ $aula->nama }}</h5>
                <form method="POST" action="{{ route('admin.aula.update', $aula) }}" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control" value="{{ $aula->kapasitas }}">
                        </div>
                        <div class="col-md-9">
                            <label class="form-label">Fasilitas</label>
                            <input type="text" name="fasilitas" class="form-control" value="{{ $aula->fasilitas }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">{{ $aula->deskripsi }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check">
                                <input type="checkbox" name="aktif" value="1" class="form-check-input"
                                       {{ $aula->aktif ? 'checked' : '' }}>
                                <label class="form-check-label">Aktif (bisa dibooking)</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
