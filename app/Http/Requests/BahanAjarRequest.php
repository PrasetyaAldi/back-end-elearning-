<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class BahanAjarRequest extends FormRequest
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
            'idrb' => 'required|exists:ruangbelajar,idrb',
            'namafile' => 'nullable',
            'istugas' => 'required|in:1,0',
            'deskripsi' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ];
        if ($this->method() == 'PUT') {
            $rules['namafile'] = 'nullable';
            $rules['istugas'] = 'nullable|in:1:0';
            $rules['deskripsi'] = 'nullable';
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
            'idrb.required' => 'Ruang Belajar tidak boleh kosong',
            'idrb.exists' => 'Ruang Belajar tidak ditemukan',
            'istugas.required' => 'Tugas tidak boleh kosong',
            'istugas.in' => 'Tugas tidak valid',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'file.mimes' => 'File harus berupa PDF, DOC, atau DOCX',
            'file.max' => 'File maksimal 2 MB'
        ];
    }
}
