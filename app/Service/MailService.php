<?php

namespace App\Service;

use App\ArrayHelper;
use App\Exceptions\api\InvalidRequestException;
use App\Exceptions\api\project\ProjectNotFoundException;
use App\Exceptions\api\template\TemplateNotFoundException;
use App\Jobs\ScheduledEmail;
use App\Models\entities\MailConfig;
use App\Models\mail\MailObject;
use App\Models\mail\MailStatus;
use App\Models\Project;
use App\Models\ProjectSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

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

    /**
     * @throws NotFoundExceptionInterface
     * @throws ProjectNotFoundException
     * @throws ContainerExceptionInterface
     */
    public function queueMail(MailObject $recipientMailObject, string $recipientMailAddress, string $requestId)
    {
        $jobIdentifier = Str::uuid();
        $mailConfig = $this->getMailConfig();
        ScheduledEmail::dispatch($requestId, $jobIdentifier, $recipientMailAddress, $recipientMailObject->getSubject(), $recipientMailObject->getBody(), $mailConfig);
        $projectId = session()->get('project_id');
        $this->logMail($recipientMailObject, $recipientMailAddress, $requestId, $projectId, $jobIdentifier);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Exception
     */
    private function getMailConfig()
    {
        $projectId = session()->get('project_id');
        if (!$projectId) {
            throw new \Exception('Project is not defined in session!');
        }
        $projectConfig = ProjectSettings::where('project_id', $projectId)->first();
        return MailConfig::getFromProjectConfiguration($projectConfig);
    }

    /**
     * @throws ProjectNotFoundException
     */
    private function logMail(MailObject $mailObject, string $mailAddress, string $requestId, string $projectId, string $jobId): void
    {
        $project = Project::query()->find($projectId);
        if (!$project) {
            throw new ProjectNotFoundException();
        }
        $project->queue()->create([
            'id' => $jobId,
            'request_id' => $requestId,
            'mail_address' => $mailAddress,
            'mail_subject' => $mailObject->getSubject(),
            'mail_body' => $mailObject->getBody(),
            'status' => MailStatus::WAITING
        ]);
    }


}
