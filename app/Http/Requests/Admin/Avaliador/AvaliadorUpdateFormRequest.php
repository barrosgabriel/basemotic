<?php

namespace App\Http\Requests\Admin\Avaliador;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AvaliadorUpdateFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'nascimento'            => 'sometimes|nullable|date_format:d-m-Y',
            'sexo'                  => ['required', Rule::in(['masculino', 'feminino']),],
            'grauDeInstrucao'       => ['required', Rule::in(['Técnico', 'Graduado', 'Mestrado', 'Doutorado']),],
            'email'                 => 'required|email',
            'telefone'              => 'sometimes|nullable|digits_between:8, 16',
            'instituicao'           => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'cpf'                   => 'sometimes|nullable|min:14',
            'cep'                   => 'sometimes|nullable|digits:8',
            'bairro'                => 'sometimes|nullable|string|max:100',
            'rua'                   => 'sometimes|nullable|string|max:100',
            'numero'                => 'sometimes|nullable|digits_between:0,5',
            'complemento'           => 'sometimes|nullable|string',
            'cidade'                => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'estado'                => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'pais'                  => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'username'              => 'unique:users,username',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é de preenchimento obrigatório!',
            'name.regex' => 'Insira um nome sem números!',
            'name.between' => 'Insira um nome entre entre 3 ou 100 caracteres!',

            'nascimento.required' => 'O campo nascimento é de preencimento obrigatório',
            'nascimento.date' => 'Insira uma data sem letras',

            'sexo.required' => 'O campo sexo é de preencimento obrigatório',

            'grauDeInstrucao.required' => 'O campo sexo é de preencimento obrigatório',

            'email.required' => 'O campo email é de preenchimento obrigatório!',
            'email.email' => 'Insira um e-mail válido!',

            'telefone.digits_between' => 'Insira um telefone que tenha entre 8 e 16 dígitos!',

            'insituicao.required' => 'O campo instituição é de preenchimento obrigatório',
            'insituicao.string' => 'Insira uma instituição válida',

            'cpf.digits' => 'Insira um CPF de 11 caracteres!',

            'cep.digits' => 'Insira um cep válido!',

            'email.email' => 'Insira um e-mail válido!',

            'bairro.max' => 'Insira um bairro válido!',
            'bairro.string' => 'Não insira caracteres especiais',

            'rua.max' => 'Insira uma rua válida!',
            'rua.string' => 'Não insira caracteres especiais!',

            'numero.digits_between' => 'Insira um número com no máximo 5 dígitos!',

            'complemento.string' => 'Insira um complemento sem caracteres especiais!',

            'cidade.regex' => 'Insira uma cidade sem caracteres especiais!',

            'estado.regex' => 'Insira um estado sem caracteres especiais!',

            'pais.regex' => 'Insira um país sem caracteres especiais!',

            'username.unique' => 'O usuário para login no sistema já está em uso, escolha outro por favor.',
        ];
    }
}
