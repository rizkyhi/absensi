<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Kelas
        $kelas = [];
        $kelasData = [
            ['nama' => 'X RPL 1', 'tingkat' => 'X', 'jurusan' => 'RPL', 'kapasitas' => 30],
            ['nama' => 'X RPL 2', 'tingkat' => 'X', 'jurusan' => 'RPL', 'kapasitas' => 28],
            ['nama' => 'XI RPL 1', 'tingkat' => 'XI', 'jurusan' => 'RPL', 'kapasitas' => 32],
            ['nama' => 'XII RPL 1', 'tingkat' => 'XII', 'jurusan' => 'RPL', 'kapasitas' => 25],
        ];

        foreach ($kelasData as $data) {
            $k = Kelas::create([
                'nama_kelas' => $data['nama'],
                'tingkat' => $data['tingkat'],
                'jurusan' => $data['jurusan'],
                'kapasitas' => $data['kapasitas'],
            ]);
            $kelas[] = $k;
        }

        // Create Siswas
        $siswas = [];
        $counter = 1;

        foreach ($kelas as $k) {
            for ($i = 1; $i <= rand(20, $k->kapasitas); $i++) {
                $siswa = Siswa::create([
                    'kelas_id' => $k->id,
                    'nis' => str_pad($counter, 5, '0', STR_PAD_LEFT),
                    'nama_lengkap' => 'Siswa ' . $counter,
                    'jenis_kelamin' => $counter % 2 == 0 ? 'Perempuan' : 'Laki-laki',
                    'tanggal_lahir' => Carbon::now()->subYears(rand(15, 18))->subDays(rand(1, 365)),
                    'alamat' => 'Alamat Siswa ' . $counter,
                    'no_telp' => '0821' . str_repeat($counter % 10, 8),
                    'nama_orang_tua' => 'Orang Tua ' . $counter,
                ]);
                $siswas[] = $siswa;
                $counter++;
            }
        }

        // Create Absensi for last 7 days
        foreach ($kelas as $k) {
            foreach ($k->siswas as $siswa) {
                for ($i = 0; $i < 7; $i++) {
                    $status = ['Hadir', 'Hadir', 'Hadir', 'Hadir', 'Hadir', 'Sakit', 'Izin', 'Alpa'];
                    $randomStatus = $status[array_rand($status)];

                    Absensi::create([
                        'siswa_id' => $siswa->id,
                        'kelas_id' => $k->id,
                        'tanggal_absen' => Carbon::now()->subDays($i),
                        'status' => $randomStatus,
                        'keterangan' => $randomStatus === 'Sakit' ? 'Sakit' : ($randomStatus === 'Izin' ? 'Izin' : null),
                    ]);
                }
            }
        }
    }
}


