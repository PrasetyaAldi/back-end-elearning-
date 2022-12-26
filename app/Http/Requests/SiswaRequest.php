<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class SiswaRequest extends FormRequest
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
        $rules = [
            'nisn' => 'required|max:10|unique:siswa,nisn',
            'nama' => 'required',
            'npsn' => 'required|max:8|exists:sekolah,npsn',
            'email' => 'email|unique:users,email'
        ];
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules['nisn'] = 'required|max:10';
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     * 
     * @return array
     */
    protected function messages(): array
    {
        return [
            'nisn.required' => 'NISN tidak boleh kosong',
            'nisn.max' => 'NISN maksimal 10 karakter',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nama.required' => 'Nama tidak boleh kosong',
            'npsn.required' => 'NPSN tidak boleh kosong',
            'npsn.max' => 'NPSN maksimal 8 karakter',
            'npsn.exists' => 'NPSN tidak terdaftar',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar'
        ];
    }
}
