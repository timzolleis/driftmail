<?php

namespace App\Http\Controllers\api;

use App\Jobs\ScheduledEmail;
use App\Models\MailQueue;
use App\Service\MailRequestParsingService;
use App\Service\NetlifyConfigurationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class MailController extends BaseController
{
    use DispatchesJobs;

    protected NetlifyConfigurationService $netlifyConfigurationService;
    protected MailRequestParsingService $mailRequestParsingService;

    public function __construct(NetlifyConfigurationService $netlifyConfigurationService, MailRequestParsingService $mailRequestParsingService)
    {
        $this->netlifyConfigurationService = $netlifyConfigurationService;
        $this->mailRequestParsingService = $mailRequestParsingService;
    }

    public function send(Request $request)
    {
        try {
            $requestId = Str::uuid();
            $userMailRequests = $this->mailRequestParsingService->parseMailRequest($request);
            foreach ($userMailRequests as $request) {
                $mailConfig = $request['mailConfig'];
                $mailRequest = $request['mailRequest'];
                $mailAddress = $request['mailAddress'];
                $mailJob = new ScheduledEmail($mailConfig, $mailRequest, $mailAddress, $requestId);
                $jobId = app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($mailJob);
                MailQueue::create([
                    'request_id' => $requestId,
                    'job_id' => $jobId,
                    'mail_address' => $mailAddress,
                    'status' => 'waiting'
                ]);
            }
            return \response([
                'request_id' => $requestId
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return \response([
                'error' => "Email template does not exist"], 404);
        }
    }


    public function getStatus(string $requestId)
    {
        $jobs = MailQueue::where('request_id', $requestId)->get();
        return \response([
            'jobs' => $jobs
        ], 200);

    }


}
