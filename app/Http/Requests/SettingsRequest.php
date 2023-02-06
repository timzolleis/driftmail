<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SettingsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'apiKey' => 'required',
            'mailHost' => 'required',
            'mailPort' => 'required',
            'mailUser' => 'required',
            'mailPassword' => 'required',
            'mailSendingAddress' => 'required',
            'mailSendingName' => 'required',
            'testMailReceiver' => 'nullable',
        ];
    }

}
