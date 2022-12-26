<?php

namespace App\Services;

use App\Http\Requests\NilaiTugasRequest;
use App\Models\Bahanajar;
use App\Models\Nilaitugas;

class NilaiTugasService
{
    /**
     * store into database
     */
    public function store($request, Nilaitugas $nilaitugas)
    {
        try {
            if ($request->file) {
                $filename = date('YmdHis') . '.' . $request->file->extension();
                $request->file->move('uploads', $filename);
            }
            $data = $nilaitugas->create([
                'nisn' => $request->nisn,
                'idbahanajar' => $request->idbahanajar,
                'jawaban' => $request->jawaban,
                'namafile' => $request->file ? $request->file->getClientOriginalName() : null,
                'file' => $filename ?: null,
                'nangka' => $request->nangka,
                'nhuruf' => $request->nhuruf,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Nilai Tugas berhasil ditambahkan',
                'data' => $data
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * siswa update jawaban tugas
     */
    public function updateTugas(NilaiTugasRequest $request, Nilaitugas $nilaitugas)
    {
        try {
            if ($request->file) {
                $filename = date('YmdHis') . '.' . $request->file->extension();
                $request->file->move('uploads', $filename);
            }
            $data = $nilaitugas->update([
                'jawaban' => $request->jawaban,
                'namafile' => $request->file ? $request->file->getClientOriginalName() : null,
                'file' => $filename ?: null,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Nilai Tugas berhasil diupdate',
                'data' => $data
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * menampilkan jawaban siswa
     */
    public function tugasSiswa($idbahanajar)
    {
        try {
            // $data = $nilaitugas->with('bahanajar')->where('idbahanajar', $idbahanajar)->get();
            $bahanajar = Bahanajar::with(['nilaitugas' => function ($q) {
                $q->with('siswa');
                $q->orderBy('nangka', 'desc');
            }])->where('idbahanajar', $idbahanajar)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Nilai Tugas berhasil ditampilkan',
                'data' => $bahanajar[0]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * update nilai tugas siswa
     */
    public function updateNilai($request, Nilaitugas $nilaitugas)
    {
        try {
            $nilaitugas->update([
                'nangka' => $request->nangka,
                'nhuruf' => $request->nhuruf,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Nilai Tugas berhasil diupdate',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /** 
     * get nilai siswa 
     * 
     */
    public function NilaiSiswa($idnilai)
    {
        try {
            $data = Nilaitugas::with(['bahanajar'])->where('idnilai', $idnilai)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Nilai Tugas berhasil ditampilkan',
                'data' => $data[0]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * download jawaban siswa
     */
    public function downloadJawaban($idnilai)
    {
        try {
            $data = Nilaitugas::find($idnilai);
            $file = public_path('uploads/' . $data->file);
            $headers = array(
                'Content-Type: application/pdf',
            );
            return response()->download($file, $data->namafile, $headers);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
