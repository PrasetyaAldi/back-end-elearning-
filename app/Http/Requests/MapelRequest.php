<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class MapelRequest extends FormRequest
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
            'idmp' => 'required|string|max:10',
            'namamp' => 'required|string|max:50',
        ];
        if ($this->method() == 'PUT') {
            $rules['idmp'] = 'string|max:10|unique:matapelajaran,idmp,' . $this->idmp . ',idmp';
        }
        return $rules;
    }

    /**
     * get message of the validation
     */
    protected function messages(): array
    {
        return [
            'namamp.required' => 'Nama Matapelajaran harus diisi',
            'idmp.required' => 'Kode Matapelajaran harus diisi',
            'idmp.unique' => 'Kode Matapelajaran sudah ada',
            'idmp.max' => 'Kode Matapelajaran maksimal 10 karakter',
        ];
    }
}
