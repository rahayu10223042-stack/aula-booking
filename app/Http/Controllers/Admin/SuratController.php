<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Surat;
use App\Services\NomorSuratService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    // buku agenda surat keluar: daftar semua surat lintas jenis
    public function index(Request $request)
    {
        $surat = Surat::with('jenisSurat', 'pembuat')
            ->when($request->jenis_surat_id, fn ($q) => $q->where('jenis_surat_id', $request->jenis_surat_id))
            ->latest('tanggal_surat')
            ->paginate(20);

        $jenisSurat = JenisSurat::orderBy('nama')->get();

        return view('admin.surat.index', compact('surat', 'jenisSurat'));
    }

    // form input surat manual (jenis surat selain peminjaman aula)
    public function create()
    {
        $jenisSurat = JenisSurat::orderBy('nama')->get();

        return view('admin.surat.create', compact('jenisSurat'));
    }

    // simpan surat manual -> tetap dapat nomor resmi dari sistem
    public function store(Request $request, NomorSuratService $nomorSuratService): RedirectResponse
    {
        $data = $request->validate([
            'jenis_surat_id' => ['required', 'exists:jenis_surat,id'],
            'perihal' => ['required', 'string', 'max:255'],
            'tujuan' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $jenisSurat = JenisSurat::findOrFail($data['jenis_surat_id']);

        $surat = $nomorSuratService->buatSurat($jenisSurat, Auth::user(), $data);

        return redirect()->route('admin.surat.index')
            ->with('success', "Surat berhasil dicatat dengan nomor {$surat->nomor_surat}.");
    }
}
