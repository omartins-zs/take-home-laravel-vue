<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterExamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'laterality' => 'nullable|in:OD,OE,AO',
            'comment'    => 'required|string',
            'group'      => 'required|string|in:Individual,Grupo 1,Grupo 2,Grupo 3,Grupo 4,Grupo 5',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'O nome do exame é obrigatório.',
            'name.string'          => 'O nome do exame deve ser um texto.',
            'name.max'             => 'O nome do exame não pode passar de 255 caracteres.',
            'laterality.in'        => 'A lateralidade deve ser OD, OE ou AO.',
            'comment.required'     => 'O comentário é obrigatório.',
            'comment.string'       => 'O comentário deve ser um texto.',
            'group.required'       => 'O grupo do exame é obrigatório.',
            'group.string'         => 'O grupo deve ser um texto.',
            'group.in'             => 'O grupo deve ser: Individual, Grupo 1, Grupo 2, Grupo 3, Grupo 4 ou Grupo 5.',
        ];
    }
}
