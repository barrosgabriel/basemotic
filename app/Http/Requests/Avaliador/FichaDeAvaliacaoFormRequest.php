<?php

namespace App\Http\Requests\Avaliador;

use Illuminate\Foundation\Http\FormRequest;

class FichaDeAvaliacaoFormRequest extends FormRequest
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
            'notaUm' => 'required',
            'notaDois' => 'required',
            'notaTres' => 'required',
            'notaQuatro' => 'required',
            'notaCinco' => 'required',
            'notaSeis' => 'required',
            'notaSete' => 'required',
            'observacao' => 'sometimes|nullable|between:0,480',
        ];
    }

    public function messages()
    {
        return [

            'notaUm.required' => 'Escolha a primeira nota',
            'notaDois.required' => 'Escolha a segunda nota',
            'notaTres.required' => 'Escolha a terceira nota',
            'notaQuatro.required' => 'Escolha a quarta nota',
            'notaCinco.required' => 'Escolha a quinta nota',
            'notaSeis.required' => 'Escolha a sexta nota',
            'notaSete.required' => 'Escolha a sétima nota',
        ];
    }
}