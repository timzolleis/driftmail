<?php

namespace App\Jobs;

use App\Mail\ApiMail;
use App\Models\entities\MailConfig;
use App\Models\entities\MailRequest;
use App\Models\MailQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class ScheduledEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $requestId;
    private MailConfig $mailConfig;
    private MailRequest $mailRequest;
    private string $recipientAddress;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MailConfig $mailConfig, MailRequest $mailRequest, string $recipientAddress, string $requestId)
    {
        $this->mailConfig = $mailConfig;
        $this->mailRequest = $mailRequest;
        $this->recipientAddress = $recipientAddress;
        $this->$requestId = $requestId;

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
        Mail::to($this->recipientAddress)->send(new ApiMail($this->mailRequest));

        return $this->job->getJobId();
    }
}
