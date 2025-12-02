<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total Statistics
        $totalSiswa = Siswa::count();
        $totalKelas = Kelas::count();
        $totalAbsensi = Absensi::count();

        // Absensi hari ini
        $hariIni = Carbon::today();
        $absensiHariIni = Absensi::whereDate('tanggal_absen', $hariIni)->count();

        // Status absensi bulan ini
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $statusAbsensi = Absensi::whereMonth('tanggal_absen', $bulanIni)
            ->whereYear('tanggal_absen', $tahunIni)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Data grafik per hari
        $perHari = Absensi::selectRaw('DATE(tanggal_absen) as tanggal, COUNT(*) as total')
            ->whereMonth('tanggal_absen', $bulanIni)
            ->whereYear('tanggal_absen', $tahunIni)
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Persentase kehadiran
        $totalAbsensiHariBulanIni = Absensi::whereMonth('tanggal_absen', $bulanIni)
            ->whereYear('tanggal_absen', $tahunIni)
            ->count();

        $hadir = $statusAbsensi['Hadir'] ?? 0;
        $presentasiKehadiran = $totalAbsensiHariBulanIni > 0 ? round(($hadir / $totalAbsensiHariBulanIni) * 100, 1) : 0;

        return view('dashboard.admin', [
            'totalSiswa' => $totalSiswa,
            'totalKelas' => $totalKelas,
            'totalAbsensi' => $totalAbsensi,
            'absensiHariIni' => $absensiHariIni,
            'statusAbsensi' => $statusAbsensi,
            'perHari' => $perHari,
            'presentasiKehadiran' => $presentasiKehadiran,
            'user' => $user,
        ]);
    }
}
