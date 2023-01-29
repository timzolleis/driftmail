<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ModifyProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'apiKey' => 'required',
            'mailSendingAddress' => 'required',
            'mailUser' => 'required',
            'mailHost' => 'required',
            'mailPort' => 'required',
            'mailPassword' => 'required',
            'mail_test_receiver' => 'nullable'
        ];
    }

}
