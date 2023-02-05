<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class MailSendRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mail' => 'required',
            'mail.template' => 'required',
            'mail.variables' => 'nullable',
            'recipients' => 'required',
            'recipients.*.mailAddress' => 'required',
        ];
    }
}
