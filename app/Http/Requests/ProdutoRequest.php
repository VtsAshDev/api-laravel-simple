<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProdutoRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $produtoId = $this->route('produto');

        $rules = [
            'nome' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'descricao' => 'required|string|min:3|max:100',
            'valor' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ];


        if ($this->isMethod('POST')) {
            $rules['nome'][] = Rule::unique('produtos', 'nome');
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['nome'][] = Rule::unique('produtos', 'nome')->ignore($produtoId);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'nome.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'nome.unique' => 'Já existe um produto com este nome.',

            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.string' => 'O campo descrição deve ser uma string.',
            'descricao.min' => 'O campo descrição deve ter no mínimo :min caracteres.',
            'descricao.max' => 'O campo descrição deve ter no máximo :max caracteres.',

            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O campo valor deve ser um número.',
            'valor.min' => 'O campo valor deve ser no mínimo :min.',

            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.integer' => 'O campo quantidade deve ser um número inteiro.',
            'quantidade.min' => 'O campo quantidade deve ser no mínimo :min.',

            'status.required' => 'O campo status é obrigatório.',
            'status.boolean' => 'O campo status deve ser verdadeiro ou falso.',
        ];
    }
}
