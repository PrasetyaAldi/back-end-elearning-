<?php

namespace App\Services;

use App\Models\Guru;

class GuruService
{
    /**
     * get guru from school
     */
    public function getGuru($kodesekolah)
    {
        try {
            $guru = Guru::where('idguru', 'ilike', '%' . $kodesekolah . '%')->get();
            $data = [];
            foreach ($guru as $g) {
                $data[] = [
                    'idguru' => $g->idguru,
                    'nip' => $g->nip,
                    'alamat' => $g->alamat,
                    'nama' => $g->nama,
                ];
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Data guru berhasil didapatkan',
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
