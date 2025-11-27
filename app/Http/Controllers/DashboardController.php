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

        $totalSiswa = Siswa::count();
        $totalKelas = Kelas::count();
        $totalAbsensi = Absensi::count();

        // Statistik absensi hari ini
        $hariIni = Carbon::today();
        $absensiHariIni = Absensi::whereDate('tanggal_absen', $hariIni)->count();

        // Statistik status absensi bulan ini
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $statusAbsensi = Absensi::whereMonth('tanggal_absen', $bulanIni)
            ->whereYear('tanggal_absen', $tahunIni)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // Data untuk grafik
        $perHari = Absensi::selectRaw('DATE(tanggal_absen) as tanggal, COUNT(*) as total')
            ->whereMonth('tanggal_absen', $bulanIni)
            ->whereYear('tanggal_absen', $tahunIni)
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('dashboard.admin', [
            'totalSiswa' => $totalSiswa,
            'totalKelas' => $totalKelas,
            'totalAbsensi' => $totalAbsensi,
            'absensiHariIni' => $absensiHariIni,
            'statusAbsensi' => $statusAbsensi,
            'perHari' => $perHari,
        ]);
    }
}
