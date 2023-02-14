<?php

namespace App\Http\Controllers\api;

use App\Jobs\ScheduledEmail;
use App\Models\MailQueue;
use App\Service\MailRequestParsingService;
use App\Service\MailService;
use App\Service\VariableParsingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class MailController extends BaseController
{
    use DispatchesJobs;

    protected MailRequestParsingService $mailRequestParsingService;
    protected MailService $mailService;
    protected VariableParsingService $variableParsingService;

    public function __construct(MailRequestParsingService $mailRequestParsingService, MailService $mailService, VariableParsingService $variableParsingService)
    {
        $this->mailRequestParsingService = $mailRequestParsingService;
        $this->mailService = $mailService;
        $this->variableParsingService = $variableParsingService;
    }

    public function send(Request $request)
    {
        $requestId = Str::uuid();
        $validated = $this->mailService->validateRequest($request);
        $template = $this->mailService->getTemplate($validated);
        $recipientMailObjects = $this->variableParsingService->parseVariables($template, $validated);
        foreach ($recipientMailObjects as $recipientMailAddress => $recipientMailObject) {
            $this->mailService->queueMail($recipientMailObject, $recipientMailAddress, $requestId);
        }
        return \response([
            'request_id' => $requestId
        ], 200);
    }


    public function getStatus(string $requestId)
    {
        $jobs = MailQueue::where('request_id', $requestId)->get();
        foreach ($jobs as $job) {
            $job['job_id'] = rand();
        }
        return \response([
            'jobs' => $jobs
        ], 200);

    }


}
