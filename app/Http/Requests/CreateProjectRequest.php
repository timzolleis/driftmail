<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'apiKey' => 'required',
            'mailSendingAddress' => 'required',
            'mailUser' => 'required',
            'mailHost' => 'required',
            'mailPort' => 'required',
            'mailPassword' => 'required'
        ];
    }


}
