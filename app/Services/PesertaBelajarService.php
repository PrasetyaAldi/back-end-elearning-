<?php

namespace App\Services;

use App\Http\Requests\PesertaBelajarRequest;
use App\Models\Pesertabelajar;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class PesertaBelajarService
{
    public function addPesertaBelajar(PesertaBelajarRequest $request)
    {
        try {
            foreach ($request->nisn as $nisn) {
                Pesertabelajar::create([
                    'idkelas' => $request->idkelas,
                    'idperiode' => $request->idperiode,
                    'nisn' => $nisn,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'message' => 'Peserta belajar berhasil ditambahkan',
            'data' => [
                'idkelas' => $request->idkelas,
                'idperiode' => $request->idperiode,
                'nisn' => $request->nisn,
            ]
        ], 201);
    }

    /**
     * get Peserta Belajar
     */
    public function getPesertaBelajar($idkelas, $idperiode)
    {
        try {
            $data = [];
            $pesertaBelajar = Pesertabelajar::with('siswa')
                ->where('idkelas', $idkelas)
                ->where('idperiode', $idperiode)
                ->get(['nisn', 'idpb', 'idkelas', 'idperiode']);
            foreach ($pesertaBelajar as $pb) {
                $data[] = [
                    'idpb' => $pb->idpb,
                    'idkelas' => $pb->idkelas,
                    'idperiode' => $pb->idperiode,
                    'nisn' => $pb->nisn,
                    'nama' => $pb->siswa()->first()->nama,
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
     * get peserta belajar sekolah
     */
    public function getPesertaBelajarSekolah($kodesekolah)
    {
        try {
            $data = [];
            // $pesertaBelajar = Pesertabelajar::with(['kelas', 'periode'])
            //     ->whereHas('kelas', function ($query) use ($kodesekolah) {
            //         $query->where('idkelas', 'ilike', '%' . $kodesekolah . '%')->groupBy('idkelas');
            //     })->whereHas('periode', function ($query) use ($kodesekolah) {
            //         $query->where('idperiode', 'ilike', '%' . $kodesekolah . '%')->groupBy('idperiode');
            //     })->get();
            // $pesertaBelajar = Kelas::with([
            //     'pesertabelajar' => function ($query) use ($kodesekolah) {
            //         $query->with(['periode' => function ($query) use ($kodesekolah) {
            //             $query->where('idperiode', 'ilike', '%' . $kodesekolah . '%');
            //         }])->where('idkelas', 'ilike', '%' . $kodesekolah . '%')
            //             ->has('periode');
            //     },
            // ])->where('idkelas', 'ilike', '%' . $kodesekolah . '%')
            //     ->has('pesertabelajar')->get();
            $pesertaBelajar = Kelas::leftJoin('pesertabelajar', 'kelas.idkelas', '=', 'pesertabelajar.idkelas')
                ->leftJoin('periode', 'pesertabelajar.idperiode', '=', 'periode.idperiode')
                ->where('kelas.idkelas', 'ilike', '%' . $kodesekolah . '%')
                ->where('periode.idperiode', 'ilike', '%' . $kodesekolah . '%')
                ->groupBy('kelas.idkelas', 'kelas.namakelas', 'periode.idperiode', 'periode.namaperiode')
                ->get(['kelas.idkelas', 'kelas.namakelas', 'periode.idperiode', 'periode.namaperiode', DB::raw('count(pesertabelajar.idpb) as jumlah')]);
            foreach ($pesertaBelajar as $pb) {
                $data[] = [
                    'idpb' => $pb->idpb,
                    'namakelas' => $pb->namakelas,
                ];
            }

            return response()->json([
                'message' => 'data peserta belajar',
                'data' => $pesertaBelajar
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * delete Peserta Belajar
     */
    public function deletePesertaBelajar($idpb)
    {
        try {
            Pesertabelajar::where('idpb', $idpb)->delete();
            return response()->json([
                'message' => 'Peserta belajar berhasil dihapus',
                'data' => [
                    'idpb' => $idpb,
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
