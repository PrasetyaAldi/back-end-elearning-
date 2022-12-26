<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class NilaiTugasRequest extends FormRequest
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
            'nisn' => 'required|exists:siswa,nisn|unique:nilaitugas,nisn,NULL,idnilaitugas,idbahanajar,' . $this->idbahanajar,
            'idbahanajar' => 'required|exists:bahanajar,idbahanajar',
            'jawaban' => 'nullable',
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip,rar|max:2048',
            'nangka' => 'nullable|integer',
            'nhuruf' => 'nullable|in:A,B,C,D,E',
        ];
        if ($this->method() == 'PUT') {
            $rules['nisn'] = 'nullable';
            $rules['idbahanajar'] = 'exists:bahanajar,idbahanajar';
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
            'idnilai.required' => 'ID nilai harus diisi',
            'idnilai.exists' => 'ID nilai tidak ditemukan',
            'nisn.required' => 'NISN siswa harus diisi',
            'nisn.exists' => 'NISN siswa tidak ditemukan',
            'nisn.unique' => 'NISN siswa sudah ada',
            'file.file' => 'File harus berupa file',
            'file.mimes' => 'File harus berupa PDF, DOC, DOCX, ZIP, atau RAR',
            'file.max' => 'File maksimal 2 MB',
            'idbahanajar.required' => 'ID bahan ajar harus diisi',
            'idbahanajar.exists' => 'ID bahan ajar tidak ditemukan',
            'nangka.integer' => 'Nilai angka harus berupa bilangan bulat',
            'nhuruf.in' => 'Nilai huruf harus berupa A, B, C, D, atau E',
        ];
    }
}
