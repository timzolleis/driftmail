<?php

namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormService
{

    public function getVariables(Request $request, array $variables): array
    {
        $resultArray = [];
        foreach ($variables as $variable) {
            if ($request->input($variable)) {
                $resultArray[Str::snake($variable)] = $request->input($variable);
            }
        }
        return $resultArray;
    }

    public function getProjectCreationFormFields(Request $request): array
    {
        $requiredFields = ['name', 'description', 'apiKey', 'mailSendingAddress', 'mailUser', 'mailHost', 'mailPort', 'mailPassword', 'mailTestReceiver'];
        return $this->getVariables($request, $requiredFields);
    }


}
