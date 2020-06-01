<?php

namespace agendaInfantil\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCentroRequest extends FormRequest
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
                'centro_nombre' => 'required',
                //'centro_nombre' => 'required|max:10'
                'centro_imagen' =>  'required|image'
        ];
    }
}
