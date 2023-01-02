<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteEnderecoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'rua' => 'required|max:191',
            'numero' => 'integer',
            'bairro' => 'required|max:191',
            'cidade' => 'required|max:191',
            'estado' => 'required|max:2|string',
            'cep' => 'required',
            'cliente_id' => 'required|integer|exists:clientes,id|unique:clientes_enderecos,cliente_id'
        ];
    }
}
