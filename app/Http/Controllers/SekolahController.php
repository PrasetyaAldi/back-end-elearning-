<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SekolahController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|min:4',
                'password' => 'required|min:6'
            ],
            [
                'required'  => ':attribute harus diisi',
                'min'       => ':attribute minimal :min karakter',
            ]
        );

        if ($validator->fails()) {
            $resp = [
                'metadata' => [
                    'message' => $validator->errors()->first(),
                    'code'    => 422
                ]
            ];
            return response()->json($resp, 422);
            die();
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Crypt::decrypt($user->password) == $request->password) {

                $token = Auth::login($user);
                $resp = [
                    'response' => [
                        'token' => $token
                    ],
                    'metadata' => [
                        'message' => 'OK',
                        'code'    => 200
                    ]
                ];

                return response()->json($resp);
            } else {

                $resp = [
                    'metadata' => [
                        'message' => 'email Atau Password Tidak Sesuai',
                        'code'    => 401
                    ]
                ];

                return response()->json($resp, 401);
            }
        } else {
            $resp = [
                'metadata' => [
                    'message' => 'email Atau Password Tidak Sesuai',
                    'code'    => 401
                ]
            ];

            return response()->json($resp, 401);
        }
    }
}
