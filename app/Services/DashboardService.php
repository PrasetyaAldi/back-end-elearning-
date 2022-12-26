<?php

namespace App\Services;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Ruangbelajar;
use App\Models\Siswa;
use App\Models\User;

class DashboardService
{
    /**
     * get list data for dashboard
     */
    public function index($npsn)
    {
        try {
            $kelas = Kelas::where('npsn', $npsn)->count();
            $guru = Guru::where('npsn', $npsn)->count();
            $siswa = Siswa::where('npsn', $npsn)->count();
            $data = [
                'jumlahkelas' => $kelas,
                'jumlahguru' => $guru,
                'jumlahsiswa' => $siswa,
            ];
            return response()->json([
                'status' => 'success',
                'message' => 'Data dashboard berhasil didapatkan',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
