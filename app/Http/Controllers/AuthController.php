<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required|min:8'
            ],
            [
                'required'  => ':attribute harus diisi',
                'min'       => ':attribute minimal :min karakter',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'periksa spesifikasi API',
                'data' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $credential = $request->only('email', 'password');
                $data = [
                    'id' => $user->user_id,
                    'email' => $user->email,
                    'role' => $user->role,
                ];

                if ($user->role == 'admin') {
                    $sekolah = Sekolah::where('npsn', $user->user_id)->first();
                    $data['kodesekolah'] = $sekolah->kodesekolah;
                } elseif ($user->role == 'guru') {
                    $idguru = str_replace(' ', '', $user->user_id);
                    $guru = Guru::where('idguru', $idguru)->first();
                    $data['idguru'] = $guru->idguru;
                }

                if (!$token = JWTAuth::claims($data)->attempt($credential)) {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
                return $this->respondWithToken($token);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => 'password yang anda masukkan salah',
                    'data' => ''
                ], 401);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Email anda belum terdaftar.',
                'data' => ''
            ], 401);
        }
    }

    /**
     * response with token
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token_type' => 'bearer',
            'access_token' => $token,
        ]);
    }

    /**
     * logout
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'success' => true,
            'message' => 'logout berhasil',
            'data' => ''
        ], 200);
    }
}
