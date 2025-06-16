<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'observations' => 'nullable|string',
            'exam_ids'     => 'required|array',
            'exam_ids.*'   => 'integer|exists:exams,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'         => 'O nome do pacote é obrigatório.',
            'name.string'           => 'O nome do pacote deve ser um texto.',
            'name.max'              => 'O nome do pacote não pode ter mais que 255 caracteres.',
            'observations.string'   => 'As observações devem ser um texto.',
            'exam_ids.required'     => 'Você deve selecionar pelo menos um exame.',
            'exam_ids.array'        => 'A lista de exames deve ser um array.',
            'exam_ids.*.integer'    => 'Cada exame deve ter um ID numérico válido.',
            'exam_ids.*.exists'     => 'Algum dos exames selecionados não existe na base de dados.',
        ];
    }
}
