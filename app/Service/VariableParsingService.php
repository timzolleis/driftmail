<?php

namespace App\Service;

use App\ArrayHelper;
use App\Models\mail\MailObject;
use App\Models\Project;
use App\Models\Template;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VariableParsingService
{
    public function parseVariables(Template $template, array $validatedRequest)
    {
        $mailObject = new MailObject($template->subject, $template->body);

        if (ArrayHelper::getValueWithDotAnnotation($validatedRequest, 'variables') !== null) {
            $this->parseGlobalVariables($mailObject, $validatedRequest);
        }
        $recipientMailObjects = [];
        foreach (ArrayHelper::getValueWithDotAnnotation($validatedRequest, 'recipients') as $recipient) {
            $mailAddress = ArrayHelper::getValueWithDotAnnotation($recipient, 'mailAddress');
            $mailObject = $this->parseLocalVariables($mailObject, $recipient);
            $recipientMailObjects[] = [
                'mailAddress' => $mailAddress,
                'mailObject' => $mailObject
            ];
        }
        return $recipientMailObjects;
    }


    function parseGlobalVariables(MailObject $mailObject, array $recipientOrMailRequest)
    {
        $project = Project::query()->find(session()->get('project_id'));
        $allVariables = $this->getVariableKeyValueArray($project->variables()->where('scope', 'global:all')->get(), $recipientOrMailRequest);
        $subjectVariables = $this->getVariableKeyValueArray($project->variables()->where('scope', 'global:subject')->get(), $recipientOrMailRequest);
        $bodyVariables = $this->getVariableKeyValueArray($project->variables()->where('scope', 'global:body')->get(), $recipientOrMailRequest);
        $this->parseAllVariables($mailObject, $allVariables);
        $mailObject->setSubject($this->parseSubjectVariables($mailObject, $subjectVariables));
        $mailObject->setBody($this->parseBodyVariables($mailObject, $bodyVariables));
    }


    function parseLocalVariables(MailObject $mailObject, array $recipientOrMailRequest)
    {
        $userMailObject = new MailObject($mailObject->getSubject(), $mailObject->getBody());
        if (ArrayHelper::getValueWithDotAnnotation($recipientOrMailRequest, 'variables') !== null) {
            $project = Project::query()->find(session()->get('project_id'));
            $allVariables = $this->getVariableKeyValueArray($project->variables()->where('scope', 'user:all')->get(), $recipientOrMailRequest);
            $subjectVariables = $this->getVariableKeyValueArray($project->variables()->where('scope', 'user:subject')->get(), $recipientOrMailRequest);
            $bodyVariables = $this->getVariableKeyValueArray($project->variables()->where('scope', 'user:body')->get(), $recipientOrMailRequest);
            $this->parseAllVariables($userMailObject, $allVariables);
            $userMailObject->setSubject($this->parseSubjectVariables($userMailObject, $subjectVariables));
            $userMailObject->setBody($this->parseBodyVariables($userMailObject, $bodyVariables));
        }
        return $userMailObject;
    }

    function getVariableKeyValueArray(Collection $variables, array $recipientOrMailRequest, bool $isLocal = false): array
    {
        $variableArray = [];
        foreach ($variables as $variable) {
            $requestVariables = ArrayHelper::getValueWithDotAnnotation($recipientOrMailRequest, 'variables');
            $variableArray[$variable->key] = ArrayHelper::getValueWithDotAnnotation($requestVariables, $variable->value);
        }
        return $variableArray;
    }


    function parseAllVariables(MailObject $mailObject, array $variablesArray)
    {
        $parsedSubject = $this->parseSubjectVariables($mailObject, $variablesArray);
        $parsedBody = $this->parseBodyVariables($mailObject, $variablesArray);
        $mailObject->setSubject($parsedSubject);
        $mailObject->setBody($parsedBody);
    }


    function parseSubjectVariables(MailObject $mailObject, array $variablesArray)
    {
        return $this->substituteText($mailObject->getSubject(), $variablesArray);
    }

    function parseBodyVariables(MailObject $mailObject, array $variablesArray)
    {
        $text = $this->substituteText($mailObject->getBody(), $variablesArray);
        return $this->substituteText($mailObject->getBody(), $variablesArray);
    }


    function substituteText(string $text, array $variablesArray)
    {
        return preg_replace_callback('#{(.*?)}#', function ($match) use ($variablesArray) {
            return $variablesArray[$match[1]] ?? '{' . $match[1] . '}';
        }, $text);
    }


}
