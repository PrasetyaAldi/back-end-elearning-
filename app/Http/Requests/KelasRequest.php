<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class KelasRequest extends FormRequest
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
            'idkelas' => 'required|max:12|unique:kelas',
            'namakelas' => 'required|max:50',
        ];
        if ($this->method() == 'PUT') {
            $rules['idkelas'] = 'max:12|unique:kelas,idkelas,' . $this->idkelas . ',idkelas';
        }
        return $rules;
    }

    /**
     * get message of the validation
     */
    protected function messages(): array
    {
        return [
            'namakelas.required' => 'namakelas harus diisi',
            'namakelas.max' => 'namakelas maksimal 50 karakter',
            'idkelas.required' => 'idkelas harus diisi',
            'idkelas.unique' => 'idkelas sudah ada',
            'idkelas.max' => 'idkelas maksimal 12 karakter',
        ];
    }
}
