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
            'kodesekolah' => 'max:6',
            'alamat' => 'required',
        ];
    }
}
