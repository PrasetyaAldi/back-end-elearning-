<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class PesertaBelajarRequest extends FormRequest
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
            'idkelas' => 'required|exists:kelas,idkelas|size:12',
            'idperiode' => 'required|exists:periode,idperiode',
            'nisn' => 'required|array|exists:siswa,nisn|unique:pesertabelajar,nisn,NULL,idpb,idkelas,' . $this->idkelas . ',idperiode,' . $this->idperiode,
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    protected function messages(): array
    {
        return [
            'idkelas.required' => 'Kelas harus diisi',
            'idperiode.required' => 'Periode harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'nisn.exists' => 'NISN tidak ditemukan',
            'nisn.unique' => 'NISN sudah terdaftar',
        ];
    }
}
