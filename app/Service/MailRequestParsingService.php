<?php

namespace App\Service;

use App\ArrayHelper;
use App\Jobs\ScheduledEmail;
use App\Mail\ApiMail;
use App\Models\entities\MailConfig;
use App\Models\entities\MailRequest;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailRequestParsingService
{
    public function parseMailRequest(Request $request)
    {
        $template = $this->getMailTemplate($request->input('mail.template'));
        $mailRequest = $this->parseGlobalVariables(new MailRequest($template->subject, $template->text), $request);
        $userMailRequests = [];
        foreach ($request->input('recipients') as $recipient) {
            Log::debug("Parsing local variables");
            $userMailRequest = $this->parseLocalVariables($mailRequest, $recipient);
            $mailConfig = MailConfig::getFromConfigurationArray(Config::get('mail'));
            $recipientAddress = $recipient['mailAddress'];
            $userMailRequests[] = [
                'mailConfig' => $mailConfig,
                'mailAddress' => $recipientAddress,
                'mailRequest' => $userMailRequest
            ];
        }
        return $userMailRequests;

    }

    private function getMailTemplate(string $templateName)
    {
        return Template::where('name', $templateName)->firstOrFail();
    }


    private function parseLocalVariables(MailRequest $mailRequest, array $recipient)
    {
        $localVariableObjects = Auth::user()->variables()->where('is_global', false)->get();
        $localVariables = [];
        foreach ($localVariableObjects as $localVariableObject) {
            $replacementValue = $localVariableObject->value;
            $value = ArrayHelper::getValueWithDotAnnotation($recipient['variables'], $replacementValue);
            $localVariables[$localVariableObject->key] = $value;
        }
        return new MailRequest($this->parseVariable($mailRequest->getSubject(), $localVariables), $this->parseVariable($mailRequest->getBody(), $localVariables));

    }

    private function parseGlobalVariables(MailRequest $mailRequest, Request $request): MailRequest
    {
        $globalVariableObjects = Auth::user()->variables()->where('is_global', true)->get();
        $globalVariables = [];
        foreach ($globalVariableObjects as $globalVariableObject) {
            $replacementValue = $globalVariableObject->value;
            $globalVariables[$globalVariableObject->key] = $request->input("globalVariables.$replacementValue");
        }
        $mailRequest->setSubject($this->parseVariable($mailRequest->getSubject(), $globalVariables));
        $mailRequest->setBody($this->parseVariable($mailRequest->getBody(), $globalVariables));
        return $mailRequest;
    }
    private function parseVariable(string $textToReplace, array $replacementVariables): array|string|null
    {
        return preg_replace_callback('#{(.*?)}#', function ($match) use ($replacementVariables) {
            return $replacementVariables[$match[1]] ?? '{' . $match[1] . '}';
        }, $textToReplace);
    }


}



