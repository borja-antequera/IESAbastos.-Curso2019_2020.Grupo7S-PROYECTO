<?php

namespace agendaInfantil\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'menu_nombre' => 'required',
            'menu_desayuno_nombre' => 'required',
            'menu_primero_nombre' => 'required',
            'menu_postre_nombre' => 'required',
            'menu_merienda_nombre' => 'required'
        ];
        
    }
}
