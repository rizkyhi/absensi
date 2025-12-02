<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        try {
            $query = Absensi::with(['siswa', 'kelas']);

            if ($request->filled('kelas_id')) {
                $query = $query->where('kelas_id', $request->kelas_id);
            }

            if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
                $query = $query->whereBetween('tanggal_absen', [
                    $request->tanggal_mulai,
                    $request->tanggal_akhir
                ]);
            }

            if ($request->filled('status')) {
                $query = $query->where('status', $request->status);
            }

            $absensi = $query->orderBy('tanggal_absen', 'desc')->get();
            $kelas = $request->filled('kelas_id') ? Kelas::find($request->kelas_id) : null;

            $html = '<html><head><meta charset="utf-8"></head><body>';
            $html .= '<h2 style="text-align: center;">Laporan Absensi</h2>';
            
            if ($kelas) {
                $html .= '<p>Kelas: ' . htmlspecialchars($kelas->nama_kelas) . '</p>';
            }
            
            $html .= '<p>Tanggal: ' . ($request->tanggal_mulai ?? 'Semua') . ' - ' . ($request->tanggal_akhir ?? 'Semua') . '</p>';
            
            $html .= '<table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">';
            $html .= '<tr><th>No</th><th>Nama Siswa</th><th>Kelas</th><th>Tanggal</th><th>Status</th><th>Keterangan</th></tr>';

            foreach ($absensi as $key => $item) {
                $html .= '<tr>';
                $html .= '<td>' . ($key + 1) . '</td>';
                $html .= '<td>' . htmlspecialchars($item->siswa->nama_lengkap ?? '-') . '</td>';
                $html .= '<td>' . htmlspecialchars($item->kelas->nama_kelas ?? '-') . '</td>';
                $html .= '<td>' . ($item->tanggal_absen ? $item->tanggal_absen->format('d-m-Y') : '-') . '</td>';
                $html .= '<td>' . htmlspecialchars($item->status ?? '-') . '</td>';
                $html .= '<td>' . htmlspecialchars($item->keterangan ?? '-') . '</td>';
                $html .= '</tr>';
            }

            $html .= '</table></body></html>';

            // Simpan ke file temporari
            $filename = 'absensi_' . date('Y-m-d_H-i-s') . '.pdf';
            @mkdir(storage_path('app/temp'), 0777, true);
            file_put_contents(storage_path('app/temp/' . $filename), $html);

            // Return download
            return response()->download(storage_path('app/temp/' . $filename), $filename)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return back()->withErrors('Error generating PDF: ' . $e->getMessage());
        }
    }

    public function exportExcel(Request $request)
    {
        try {
            $query = Absensi::with(['siswa', 'kelas']);

            if ($request->filled('kelas_id')) {
                $query = $query->where('kelas_id', $request->kelas_id);
            }

            if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
                $query = $query->whereBetween('tanggal_absen', [
                    $request->tanggal_mulai,
                    $request->tanggal_akhir
                ]);
            }

            if ($request->filled('status')) {
                $query = $query->where('status', $request->status);
            }

            $absensi = $query->orderBy('tanggal_absen', 'desc')->get();

            $data = [];
            $data[] = ['No', 'Nama Siswa', 'Kelas', 'Tanggal', 'Status', 'Keterangan'];

            foreach ($absensi as $key => $item) {
                $data[] = [
                    $key + 1,
                    $item->siswa->nama_lengkap ?? '-',
                    $item->kelas->nama_kelas ?? '-',
                    $item->tanggal_absen ? $item->tanggal_absen->format('d-m-Y') : '-',
                    $item->status ?? '-',
                    $item->keterangan ?? '-',
                ];
            }

            // Membuat CSV
            $filename = 'absensi_' . date('Y-m-d_H-i-s') . '.csv';
            @mkdir(storage_path('app/temp'), 0777, true);
            $file = fopen(storage_path('app/temp/' . $filename), 'w');

            foreach ($data as $row) {
                fputcsv($file, $row);
            }

            fclose($file);

            return response()->download(storage_path('app/temp/' . $filename), $filename)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return back()->withErrors('Error generating Excel: ' . $e->getMessage());
        }
    }
}
