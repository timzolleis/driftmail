<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditVariableRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key' => "required | unique:variables,key," .$this->variable->id,
            'value' => 'required',
            'description' => 'nullable',
            'scope' => 'required'
        ];
    }


}
