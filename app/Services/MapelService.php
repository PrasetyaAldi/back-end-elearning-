<?php

namespace App\Services;

use App\Http\Requests\MapelRequest;
use App\Models\Matapelajaran;
use App\Models\Sekolah;

class MapelService
{
    /**
     * add mapel
     */
    public function createMapel($request)
    {
        $sekolah = Sekolah::where('npsn', auth()->user()->user_id)->firstOrFail();
        try {
            Matapelajaran::create([
                'idmp' => $sekolah->kodesekolah . '-' . $request->idmp,
                'npsn' => $sekolah->npsn,
                'namamp' => $request->namamp,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'Mapel berhasil ditambahkan',
            'data' => [
                'idmp' => $request->idmp,
                'namamp' => $request->namamp,
            ]
        ], 201);
    }

    /**
     * get mapel
     */
    public function getMapel($kodesekolah = null)
    {
        $data = [];
        try {
            $mapel = Matapelajaran::where('idmp', 'ilike', '%' . $kodesekolah . '%')->get();
            foreach ($mapel as $m) {
                $data[] = [
                    'idmp' => $m->idmp,
                    'namamp' => $m->namamp,
                ];
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    /**
     * update mapel
     */
    public function updateMapel(MapelRequest $request, $idmapel)
    {
        try {
            $matapelajaran = Matapelajaran::where('idmp', $idmapel)->firstOrFail();
            $matapelajaran->update([
                'idmp' => $request->idmp ?: $matapelajaran->idmp,
                'namamp' => $request->namamp,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'matapelajaran berhasil diubah',
            'data' => [
                'idmp' => $matapelajaran->idmp,
                'namamp' => $matapelajaran->namamp,
            ]
        ], 200);
    }

    /**
     * delete mapel
     */
    public function deleteMapel($idmapel)
    {
        try {
            $mapel = Matapelajaran::where('idmp', $idmapel)->firstOrFail();
            $mapel->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'Mapel berhasil dihapus',
            'data' => [
                'idmapel' => $idmapel,
            ]
        ], 200);
    }
}
