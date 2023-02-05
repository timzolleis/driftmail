<?php

namespace App\Jobs;

use App\Mail\ApiMail;
use App\Models\entities\MailConfig;
use App\Models\entities\MailRequest;
use App\Models\mail\MailObject;
use App\Models\MailQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use function Symfony\Component\String\b;

class ScheduledEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $requestId;
    private MailConfig $mailConfig;
    private string $subject;
    private string $body;
    private string $recipientAddress;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $requestId, string $recipientAddress, string $subject, string $body, MailConfig $mailConfig)
    {
        $this->requestId = $requestId;
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
        Config::set('mail', $this->mailConfig->getConfigurationArray());
        $app = App::getInstance();
        $app->register('Illuminate\Mail\MailServiceProvider');
        Mail::to($this->recipientAddress)->send(new ApiMail($this->subject, $this->body));
        return $this->job->getJobId();
    }
}
