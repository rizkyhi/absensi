<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('siswas')->latest()->paginate(10);
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'nullable|string|max:100',
            'kapasitas' => 'required|integer|min:1|max:100',
        ]);

        Kelas::create($validated);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $kelas->id,
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'nullable|string|max:100',
            'kapasitas' => 'required|integer|min:1|max:100',
        ]);

        $kelas->update($validated);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kelas)
    {
        $kelasId = $kelas->id;
        
        // Delete related absensi records first
        \DB::table('absensi')->where('kelas_id', $kelasId)->delete();
        
        // Delete related siswa records
        \DB::table('siswas')->where('kelas_id', $kelasId)->delete();
        
        // Delete the kelas itself
        \DB::table('kelas')->where('id', $kelasId)->delete();
        
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }

    public function show(Kelas $kelas)
    {
        $kelas->load('siswas');
        return view('kelas.show', compact('kelas'));
    }
}
