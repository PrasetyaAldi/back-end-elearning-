<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'npsn' => 'max:8',
            'nip' => 'max:18|unique:guru',
            'nisn' => 'max:10|unique:siswa',
            'kodesekolah' => 'exists:sekolah,kodesekolah|max:6',
            'alamat' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    protected function messages(): array
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'npsn.max' => 'NPSN maksimal 8 karakter',
            'nip.max' => 'NIP maksimal 18 karakter',
            'nip.unique' => 'NIP sudah terdaftar',
            'nisn.max' => 'NISN maksimal 10 karakter',
            'nisn.unique' => 'NISN sudah terdaftar',
            'kodesekolah.exists' => 'Kode sekolah tidak ditemukan',
            'kodesekolah.max' => 'Kode sekolah maksimal 6 karakter',
            'alamat.required' => 'Alamat tidak boleh kosong',
        ];
    }
}
