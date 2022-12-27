<?php

namespace App\Services;

use App\Http\Requests\RuangBelajarRequest;
use App\Models\Bahanajar;
use App\Models\Kelas;
use App\Models\Pesertabelajar;
use App\Models\Ruangbelajar;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RuangBelajarService
{
    /**
     * create ruang belajar
     * 
     * @param \App\Http\Requests\RuangBelajarRequest $request
     * @return \Illuminate\Http\Response
     */
    public function createRuangBelajar(RuangBelajarRequest $request)
    {
        try {
            $ruangbelajar = Ruangbelajar::create([
                'idmp' => $request->idmp,
                'idguru' => $request->idguru,
                'idperiode' => $request->idperiode,
                'idkelas' => $request->idkelas,
                'namarb' => $request->namarb,
                'koderb' => Str::random(6)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Ruang belajar berhasil ditambahkan',
            'data' => $ruangbelajar
        ], 201);
    }

    /**
     * get ruang belajar from school
     * 
     */
    public function getRuangBelajar($kodesekolah)
    {
        try {
            $ruangbelajar = Ruangbelajar::with(['periode' => ['siswa'], 'kelas' => ['siswa']])
                ->where('idkelas', 'ilike', '%' . $kodesekolah . '%')->orderBy('created_at', 'desc')->get();
            $data = [];
            foreach ($ruangbelajar as $rb) {
                $data[] = [
                    'idrb' => $rb->idrb,
                    'idmp' => $rb->idmp,
                    'idkelas' => $rb->idkelas,
                    'idperiode' => $rb->idperiode,
                    'namaperiode' => $rb->periode->namaperiode,
                    'namarb' => $rb->namarb,
                    'banyak_siswa' => count($rb->kelas->pesertabelajar)
                ];
            }
            return response()->json([
                'message' => 'Data Ruang Belajar',
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
     * get ruag belajar from siswa
     */
    public function getRuangBelajarSiswa($nisn)
    {
        try {
            $siswa = Pesertabelajar::where('nisn', $nisn)->get();
            $data = [];
            foreach ($siswa as $s) {
                $data[] = $s->idkelas;
            }
            $kelas = Ruangbelajar::with('periode')->whereIn('idkelas', $data)->get();
            return response()->json([
                'message' => 'success',
                'data' => $kelas
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * update ruang belajar
     */
    public function updateRuangBelajar(RuangBelajarRequest $request, $id)
    {
        try {
            $ruangbelajar = Ruangbelajar::where('idrb', $id)->first();
            $ruangbelajar->update([
                'idmp' => $request->idmp ?: $ruangbelajar->idmp,
                'idguru' => $request->idguru ?: $ruangbelajar->idguru,
                'idperiode' => $request->idperiode ?: $ruangbelajar->idperiode,
                'idkelas' => $request->idkelas ?: $ruangbelajar->idkelas,
                'namarb' => $request->namarb
            ]);
            return response()->json([
                'message' => 'success',
                'data' => $ruangbelajar
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * get ruang belajar from guru
     * 
     */
    public function getRuangBelajarGuru($idguru)
    {
        try {
            $guru = Ruangbelajar::where('idguru', $idguru)->get();
            $dataRb = [];
            foreach ($guru as $g) {
                $dataRb[] = $g->idkelas;
            }
            $kelas = Ruangbelajar::with(['kelas' => ['siswa'], 'periode'])->where('idguru', $idguru)->orderBy('created_at', 'desc')->get();
            // $kelas = Ruangbelajar::with(['bahanajar', 'kelas' => ['pesertabelajar' => function ($query)  use ($dataRb) {
            //     $query->leftJoin('ruangbelajar as r', function ($join) {
            //         $join->on('r.idkelas', '=', 'pesertabelajar.idkelas');
            //         $join->on('r.idperiode', '=', 'pesertabelajar.idperiode');
            //     });
            // }], 'periode'])->whereIn('idkelas', $dataRb)->orderBy('created_at', 'desc')->get();
            $data = [];
            foreach ($kelas as $k) {
                $data[] = [
                    'idrb' => $k->idrb,
                    'idmp' => $k->idmp,
                    'idkelas' => $k->idkelas,
                    'namaperiode' => $k->periode->namaperiode,
                    'namarb' => $k->namarb,
                    'banyak_siswa' => count($k->kelas->pesertabelajar)
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
     * get ruang belajar guru and bahan ajar
     */
    public function getBahanAjarGuru($idrb)
    {
        try {
            $kelas = Ruangbelajar::with(['bahanajar' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }, 'guru', 'kelas' => ['pesertabelajar' => function ($query) {
                $query->leftJoin('ruangbelajar as r', function ($join) {
                    $join->on('r.idkelas', '=', 'pesertabelajar.idkelas');
                    $join->on('r.idperiode', '=', 'pesertabelajar.idperiode');
                });
            }]])->where('idrb', $idrb)->get();
            $data = [];
            foreach ($kelas as $k) {
                $data = [
                    'idrb' => $k->idrb,
                    'idmp' => $k->idmp,
                    'idkelas' => $k->idkelas,
                    'idperiode' => $k->idperiode,
                    'namarb' => $k->namarb,
                    'namaguru' => $k->guru->nama,
                    'banyak_siswa' => count($k->kelas->pesertabelajar),
                    'bahanajar' => $k->bahanajar
                ];
            }
            return response()->json([
                'message' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * delete ruang belajar
     */
    public function deleteRuangBelajar($id)
    {
        try {
            $ruangbelajar = Ruangbelajar::where('idrb', $id)->first();
            $ruangbelajar->delete();
            return response()->json([
                'message' => 'Ruang belajar berhasil dihapus',
                'data' => $ruangbelajar
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * get ruang belajar for option
     */
    public function getRuangBelajarOption($idguru)
    {
        try {
            $guru = Ruangbelajar::where('idguru', $idguru)->get();
            $data = [];
            foreach ($guru as $k) {
                $data[] = [
                    'value' => $k->idrb,
                    'label' => $k->namarb
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
     * get member ruang belajar
     */
    public function getMemberRuangBelajar($idrb)
    {
        try {
            $ruangbelajar = Ruangbelajar::with(['kelas' => ['pesertabelajar' => function ($q) use ($idrb) {
                $q->leftJoin('ruangbelajar as r', function ($join) use ($idrb) {
                    $join->on('r.idkelas', '=', 'pesertabelajar.idkelas');
                    $join->on('r.idperiode', '=', 'pesertabelajar.idperiode');
                })->where('r.idrb', $idrb);
                $q->with('siswa');
            }]])->where('idrb', $idrb)->first();
            $data = [];
            foreach ($ruangbelajar->kelas->pesertabelajar as $k) {
                $data[] = [
                    'nisn' => $k->nisn,
                    'nama' => $k->siswa()->first()->nama,
                    'banyak_siswa' => count($ruangbelajar->kelas->pesertabelajar),
                ];
            }
            return response()->json([
                'message' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'data' => $th->getMessage()
            ], 500);
        }
    }
}
