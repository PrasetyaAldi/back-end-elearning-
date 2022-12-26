<?php

namespace App\Services;

use App\Models\Bahanajar;
use App\Models\Pesertabelajar;
use App\Models\Ruangbelajar;
use App\Models\Siswa;

class BahanAjarService
{
    /**
     * store into database
     * 
     */
    public function store($request)
    {
        try {
            if ($request->namafile) {
                $filename = date('YmdHis') . '.' . $request->namafile->extension();
                $request->namafile->move('uploads', $filename);
            }
            $bahanajar = Bahanajar::create([
                'idrb' => $request->idrb,
                'deskripsi' => $request->deskripsi,
                'istugas' => $request->istugas,
                'namafile' => $request->namafile ? $request->namafile->getClientOriginalName() : null,
                'file' => $filename ?: null,
                'deadline' => $request->deadline ?: null,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Bahan Ajar berhasil ditambahkan',
                'data' => $bahanajar
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * download materi
     */
    public function downloadMateri($idbahanajar)
    {
        try {
            $bahanajar = Bahanajar::find($idbahanajar);
            $file = public_path() . '/uploads/' . $bahanajar->file;
            $headers = array(
                'Content-Type: application/pdf',
            );
            return response()->download($file, $bahanajar->namafile, $headers);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * get materi guru
     */
    public function getMateriGuru($idguru)
    {
        try {
            $bahanajar = Bahanajar::with(['ruangbelajar' => function ($query) use ($idguru) {
                $query->with(['guru']);
                $query->where('idguru', $idguru);
            }])->limit(100)->orderBy('bahanajar.created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Data materi berhasil didapatkan',
                'data' => $bahanajar
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * destroy bahan ajar
     */
    public function destroy($idbahanajar)
    {
        try {
            $bahanajar = Bahanajar::find($idbahanajar);
            $bahanajar->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Bahan Ajar berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * get materi siswa
     */
    public function getMateriTugasSiswa($nisn)
    {
        try {
            $pesertabelajar = Pesertabelajar::where('nisn', $nisn)->get('idkelas');
            $ruangbelajar = Ruangbelajar::whereIn('idkelas', $pesertabelajar)->get('idrb');
            $bahanajar = Bahanajar::with(['nilaitugas' => function ($q) use ($nisn) {
                $q->where('nisn', $nisn);
            }, 'ruangbelajar' => ['guru']])->whereIn('idrb', $ruangbelajar)->orderBy('created_at', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data materi berhasil didapatkan',
                'data' => $bahanajar
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * get materi siswa dari ruang belajar
     */
    public function getMateriRuangBelajarSiswa($idrb)
    {
        try {
            $bahanajar = Bahanajar::with(['ruangbelajar' => ['guru'], 'nilaitugas'])->where('idrb', $idrb)->orderBy('created_at', 'desc')->get();
            $data = [];
            foreach ($bahanajar as $bh) {
                $data = [
                    'idrb' => $bh->ruangbelajar->idrb,
                    'namarb' => $bh->ruangbelajar->namarb,
                    'namaguru' => $bh->ruangbelajar->guru->nama,
                ];
            }
            $data['bahanajar'] = $bahanajar;
            return response()->json([
                'status' => 'success',
                'message' => 'Data materi berhasil didapatkan',
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
