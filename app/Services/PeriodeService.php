<?php

namespace App\Services;

use App\Http\Requests\PeriodeRequest;
use App\Models\Periode;
use App\Models\Sekolah;

class PeriodeService
{
    /**
     * Store Data Periode
     */
    public function createPeriode(PeriodeRequest $request)
    {
        try {
            $sekolah = Sekolah::where('npsn', auth()->user()->user_id)->firstOrFail();
            $periode = Periode::create([
                'idperiode' => $sekolah->kodesekolah . '-' . $request->idperiode,
                'npsn' => $sekolah->npsn,
                'namaperiode' => $request->namaperiode,
                'tanggalawal' => $request->tglmulai,
                'tanggalakhir' => $request->tglselesai,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Data periode berhasil ditambahkan',
                'data' => $periode
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data periode gagal ditambahkan',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Data Periode
     */
    public function getPeriode($kodesekolah = null)
    {
        $data = [];
        try {
            $periode = Periode::where('idperiode', 'ilike', '%' . $kodesekolah . '%')->get();
            foreach ($periode as $p) {
                $data[] = [
                    'idperiode' => $p->idperiode,
                    'namaperiode' => $p->namaperiode,
                    'tanggalawal' => $p->tanggalawal,
                    'tanggalakhir' => $p->tanggalakhir,
                ];
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data periode Tidak ditemukan',
                'data' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data periode',
            'data' => $data
        ], 200);
    }

    /**
     * Update Data Periode
     */
    public function updatePeriode(PeriodeRequest $request, $id)
    {
        try {
            $periode = Periode::where('idperiode', $id)->firstOrFail();
            $periode->update([
                'namaperiode' => $request->namaperiode,
                'tanggalawal' => $request->tglmulai,
                'tanggalakhir' => $request->tglselesai,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Data periode berhasil diubah',
                'data' => $periode
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data periode gagal diubah',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete Data Periode
     */
    public function deletePeriode($id)
    {
        try {
            $periode = Periode::where('idperiode', $id)->firstOrFail();
            $periode->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data periode berhasil dihapus',
                'data' => $periode
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data periode gagal dihapus',
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
