<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariableRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key' => 'required | unique:variables',
            'value' => 'required',
            'description' => 'nullable',
            'isGlobal' => 'required | boolean',
        ];
    }


}
