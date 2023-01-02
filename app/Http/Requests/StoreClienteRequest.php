<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'nome' => 'required|string',
            'empresa' =>  'max:191',
            'telefone' =>  'required|digits_between:10,11',
            'email' =>  'required|email|unique:clientes',
            'data_nascimento' =>  'required|date',
            'password' =>  'required|min:6'
        ];
    }
}
