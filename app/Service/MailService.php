<?php

namespace App\Service;

use App\ArrayHelper;
use App\Exceptions\api\InvalidRequestException;
use App\Exceptions\api\template\TemplateNotFoundException;
use App\Jobs\ScheduledEmail;
use App\Models\entities\MailConfig;
use App\Models\mail\MailObject;
use App\Models\MailQueue;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MailService
{
    /**
     * @throws \Throwable
     */
    public function validateRequest(Request $request): array
    {
        $rules = [
            'mail' => 'required',
            'mail.template' => 'required',
            'variables' => 'nullable',
            'recipients' => 'required',
            'recipients.*.mailAddress' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        throw_if($validator->fails(), new InvalidRequestException("Invalid request body", 400));
        return $validator->validated();
    }

    /**
     * @throws \Throwable
     */
    public function getTemplate(array $validatedRequest)
    {
        $user = User::query()->find(Auth::user()->getAuthIdentifier());
        $projectId = session()->get('project_id');
        $templateName = ArrayHelper::getValueWithDotAnnotation($validatedRequest, 'mail.template');
        $template = $user->projects()->where('id', $projectId)->first()->templates()->where('name', $templateName)->first();
        throw_if(!$template, new TemplateNotFoundException("The template $templateName does not exist"));
        return $template;
    }

    public function queueMail(MailObject $recipientMailObject, string $recipientMailAddress, string $requestId)
    {
        $mailConfig = MailConfig::getFromConfigurationArray(Config::get('mail'));
        $mailJob = new ScheduledEmail($requestId, $recipientMailAddress, $recipientMailObject->getSubject(), $recipientMailObject->getBody(), $mailConfig);
        $jobId = app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($mailJob);
        $project = Project::query()->find(session()->get('project_id'));
        $project->queue()->create(['request_id' => $requestId,
            'job_id' => $jobId,
            'mail_address' => $recipientMailAddress,
            'status' => 'waiting']);
    }


}
