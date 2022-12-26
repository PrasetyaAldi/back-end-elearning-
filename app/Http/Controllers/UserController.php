<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $admin = Sekolah::where('npsn', auth()->user()->user_id)->first();
            return response()->json([
                'success' => true,
                'message' => 'berhasil mengambil data',
                'data' => $admin,
            ], 200);
        } elseif (auth()->user()->role == 'guru') {
            $idguru = str_replace(' ', '', auth()->user()->user_id);
            $guru = Guru::with('sekolah')->where('idguru', $idguru)->first();
            return response()->json([
                'success' => true,
                'message' => 'berhasil mengambil data',
                'data' => $guru,
            ], 200);
        } elseif (auth()->user()->role == 'siswa') {
            $siswa = Siswa::with('sekolah')->where('nisn', auth()->user()->user_id)->first();
            return response()->json([
                'success' => true,
                'message' => 'berhasil mengambil data',
                'data' => $siswa,
            ], 200);
        }
    }
}
