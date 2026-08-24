<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aula;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        $aulas = Aula::orderBy('nama')->get();

        return view('admin.aula.index', compact('aulas'));
    }

    public function update(Request $request, Aula $aula): RedirectResponse
    {
        $data = $request->validate([
            'kapasitas' => ['nullable', 'integer', 'min:1'],
            'fasilitas' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'aktif' => ['nullable', 'boolean'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('aula', 'public');
        }

        $data['aktif'] = $request->boolean('aktif');

        $aula->update($data);

        return back()->with('success', 'Data aula berhasil diperbarui.');
    }
}
