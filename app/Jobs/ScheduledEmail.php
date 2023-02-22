<?php

namespace App\Jobs;

use App\Exceptions\ConfigRegistrationFailedException;
use App\Exceptions\MailSendingFailedException;
use App\Mail\ApiMail;
use App\Models\entities\MailConfig;
use App\Models\entities\MailRequest;
use App\Models\mail\MailObject;
use App\Models\MailQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Exception;
use function Symfony\Component\String\b;

class ScheduledEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use InteractsWithQueue;

    private string $requestId;
    private string $jobIdentifier;
    private MailConfig $mailConfig;
    private string $subject;
    private string $body;
    private string $recipientAddress;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $requestId, string $jobIdentifier, string $recipientAddress, string $subject, string $body, MailConfig $mailConfig)
    {
        $this->requestId = $requestId;
        $this->jobIdentifier = $jobIdentifier;
        $this->recipientAddress = $recipientAddress;
        $this->subject = $subject;
        $this->body = $body;
        $this->mailConfig = $mailConfig;
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            $parameters = [
                'mail_config' => $this->mailConfig
            ];
            $mailable = new ApiMail($this->subject, $this->body, $this->mailConfig->getSendingAddress(), $this->mailConfig->getSendingName());
            $mailer = app()->make('user.mailer', $parameters);
            $mailer->to($this->recipientAddress)->send($mailable);
            return $this->job->getJobId();
        } catch (\Exception $exception) {
            Log::debug("Caught exception when sending an email");
            $message = $exception->getMessage();
            $this->fail(new MailSendingFailedException("Exception: $message"));
        }

        return $this->job->uuid();
    }

    public function getJobIdentifier()
    {
        return $this->jobIdentifier;
    }


}
