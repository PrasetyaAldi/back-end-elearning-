<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class RuangBelajarRequest extends FormRequest
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
        $rules =  [
            'idkelas' => 'required|exists:kelas,idkelas|unique:ruangbelajar,idkelas,NULL,idrb,idperiode,' . $this->idperiode . ',idmp,' . $this->idmp . ',idguru,' . $this->idguru,
            'idmp' => 'required|exists:matapelajaran,idmp',
            'idguru' => 'required|exists:guru,idguru',
            'idperiode' => 'required|exists:periode,idperiode',
            'namarb' => 'required|string',
        ];
        if ($this->method() == 'PUT') {
            $rules['idkelas'] = 'exists:kelas,idkelas|unique:ruangbelajar,idkelas,' . $this->idrb . ',idrb,idperiode,' . $this->idperiode . ',idmp,' . $this->idmp . ',idguru,' . $this->idguru;
            $rules['idmp'] = 'exists:matapelajaran,idmp';
            $rules['idguru'] = 'exists:guru,idguru';
            $rules['idperiode'] = 'exists:periode,idperiode';
            $rules['namarb'] = 'required|string';
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
            'idkelas.required' => 'Kelas tidak boleh kosong',
            'idkelas.exists' => 'Kelas tidak ditemukan',
            'idmp.required' => 'Mata pelajaran tidak boleh kosong',
            'idmp.exists' => 'Mata pelajaran tidak ditemukan',
            'idguru.required' => 'Guru tidak boleh kosong',
            'idguru.exists' => 'Guru tidak ditemukan',
            'idperiode.required' => 'Periode tidak boleh kosong',
            'idperiode.exists' => 'Periode tidak ditemukan',
            'namarb.required' => 'Nama ruang belajar tidak boleh kosong',
            'namarb.string' => 'Nama ruang belajar harus berupa string',
        ];
    }
}
