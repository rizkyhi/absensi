<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Absensi::with(['siswa', 'kelas']);

        // Filter berdasarkan request
        if (request('kelas_id')) {
            $query->where('kelas_id', request('kelas_id'));
        }

        if (request('tanggal_mulai') && request('tanggal_akhir')) {
            $query->whereBetween('tanggal_absen', [
                request('tanggal_mulai'),
                request('tanggal_akhir')
            ]);
        }

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $absensi = $query->orderBy('tanggal_absen', 'desc')->paginate(15);

        // Data untuk filter
        $kelas = Kelas::all();

        return view('absensi.index', compact('absensi', 'kelas'));
    }

    public function create()
    {
        $kelas = Kelas::all();

        return view('absensi.create', compact('kelas'));
    }

    public function getSiswaByKelas($kelasId)
    {
        $siswas = Siswa::where('kelas_id', $kelasId)->get();
        return response()->json($siswas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_absen' => 'required|date',
            'absensi' => 'required|array',
            'absensi.*.siswa_id' => 'required|exists:siswas,id',
            'absensi.*.status' => 'required|in:Hadir,Sakit,Izin,Alpa',
            'absensi.*.keterangan' => 'nullable|string',
        ]);

        $user = Auth::user();

        foreach ($validated['absensi'] as $item) {
            // Cek apakah sudah ada absensi untuk siswa ini di tanggal yang sama
            $exists = Absensi::where('siswa_id', $item['siswa_id'])
                ->where('tanggal_absen', $validated['tanggal_absen'])
                ->exists();

            if (!$exists) {
                Absensi::create([
                    'siswa_id' => $item['siswa_id'],
                    'kelas_id' => $validated['kelas_id'],
                    'tanggal_absen' => $validated['tanggal_absen'],
                    'status' => $item['status'],
                    'keterangan' => $item['keterangan'] ?? null,
                ]);
            }
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan');
    }

    public function edit(Kelas $kelas, $tanggal)
    {
        $absensi = Absensi::where('kelas_id', $kelas->id)
            ->where('tanggal_absen', $tanggal)
            ->get();

        $siswas = $kelas->siswas;

        return view('absensi.edit', compact('kelas', 'tanggal', 'absensi', 'siswas'));
    }

    public function update(Request $request, Kelas $kelas, $tanggal)
    {
        $validated = $request->validate([
            'absensi' => 'required|array',
            'absensi.*.siswa_id' => 'required|exists:siswas,id',
            'absensi.*.status' => 'required|in:Hadir,Sakit,Izin,Alpa',
            'absensi.*.keterangan' => 'nullable|string',
        ]);

        foreach ($validated['absensi'] as $item) {
            Absensi::updateOrCreate(
                [
                    'siswa_id' => $item['siswa_id'],
                    'kelas_id' => $kelas->id,
                    'tanggal_absen' => $tanggal,
                ],
                [
                    'status' => $item['status'],
                    'keterangan' => $item['keterangan'] ?? null,
                ]
            );
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil diperbarui');
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus');
    }
}
