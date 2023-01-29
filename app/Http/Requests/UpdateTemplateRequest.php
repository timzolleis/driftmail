<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTemplateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => "required | unique:templates,name," .$this->template->id,
            'subject' => 'required',
            'text' => 'nullable',
        ];
    }


}
