<?php

namespace App\Services;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiswaService
{
    /**
     * store new siswa
     * 
     */
    public function store($request)
    {
        try {
            $siswa = Siswa::create([
                'nisn' => $request->nisn,
                'nama' => $request->nama,
                'npsn' => $request->npsn,
            ]);
            User::create([
                'email' => $request->nisn . '@gmail.com',
                'password' => Hash::make($request->nisn),
                'role' => 'siswa',
                'user_id' => $siswa->nisn,
            ]);
            return response()->json([
                'message' => 'Siswa Berhasil Ditambahkan',
                'data' => $siswa
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function getSiswaSekolah($npsn)
    {
        $data = [];
        try {
            $siswa = Siswa::leftJoin('users as u', 'u.user_id', '=', 'siswa.nisn')
                ->where('npsn', $npsn)->get();
            foreach ($siswa as $s) {
                $data[] = [
                    'nisn' => $s->nisn,
                    'nama' => $s->nama,
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
            'data' => $siswa
        ], 200);
    }

    /**
     * update siswa
     */
    public function update($request, $nisn)
    {
        try {
            $siswa = Siswa::where('nisn', $nisn)->first();
            $siswa->update([
                'nama' => $request->nama,
            ]);
            $user = User::where('user_id', $nisn)->first();
            $user->update([
                'email' => $request->email,
                'password' => Hash::make($request->nisn),
            ]);
            return response()->json([
                'message' => 'Siswa Berhasil Diupdate',
                'data' => $siswa
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * destroy siswa
     */
    public function destroy($nisn)
    {
        try {
            $siswa = Siswa::where('nisn', $nisn)->first();
            $siswa->delete();
            $user = User::where('user_id', $nisn)->first();
            $user->delete();
            return response()->json([
                'message' => 'Siswa Berhasil Dihapus',
                'data' => $siswa
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
