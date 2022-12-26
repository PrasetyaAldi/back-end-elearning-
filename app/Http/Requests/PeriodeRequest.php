<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class PeriodeRequest extends FormRequest
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
            'idperiode' => 'required|max:12',
            'namaperiode' => 'required',
            'tglmulai' => 'required|date',
            'tglselesai' => 'required|date',
        ];
        if ($this->isMethod('PUT')) {
            $rules['idperiode'] = 'unique:periode';
        }
        return $rules;
    }
}
