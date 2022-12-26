<?php

namespace App\Services;

use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use App\Models\Sekolah;

class KelasService
{

    /**
     * createKelas
     *
     * @param  \App\Http\Requests\KelasRequest $request
     * @return void
     */
    public function createKelas($request)
    {
        $sekolah = Sekolah::where('npsn', auth()->user()->user_id)->firstOrFail();
        Kelas::create([
            'idkelas' => $sekolah->kodesekolah . '-' . $request->idkelas,
            'npsn' => $sekolah->npsn,
            'namakelas' => $request->namakelas,
        ]);
        return response()->json([
            'message' => 'Kelas berhasil ditambahkan',
            'data' => $request->all()
        ], 201);
    }

    /** 
     * get kelas from school
     * 
     */
    public function getKelas($kodesekolah)
    {
        try {
            $kelas = Kelas::where('idkelas', 'ilike', '%' . $kodesekolah . '%')->get();
            $data = [];
            foreach ($kelas as $k) {
                $data[] = [
                    'idkelas' => $k->idkelas,
                    'namakelas' => $k->namakelas,
                ];
            }
            return response()->json([
                'message' => 'success',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * update kelas
     * 
     */
    public function updateKelas(KelasRequest $request, $idkelas)
    {
        try {
            $kelas = Kelas::where('idkelas', $idkelas)->firstOrFail();
            $kelas->update([
                'idkelas' => $request->idkelas ?: $kelas->idkelas,
                'namakelas' => $request->namakelas,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'message' => 'success',
            'data' => $kelas
        ], 200);
    }

    /**
     * delete kelas
     * 
     */
    public function deleteKelas($idkelas)
    {
        try {
            $kelas = Kelas::where('idkelas', $idkelas)->firstOrFail();
            $kelas->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'message' => 'success',
            'data' => 'Kelas berhasil dihapus'
        ], 200);
    }
}
