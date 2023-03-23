<?php

namespace App\Providers;

use App\Mail\ApiMail;
use App\Models\mail\MailStatus;
use App\Models\MailQueue;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use PHPUnit\Framework\MockObject\Exception;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransportFactory;
use  Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('user.mailer', function ($app, $parameters) {
            $factory = new EsmtpTransportFactory;
            $mailConfig = $parameters['mail_config'];
            $transport = $factory->create(new Dsn(!empty($config['encryption']) && $mailConfig->getEncryption() === 'tls' ? (($mailConfig->getPort() == 465) ? 'smtps' : 'smtp') : '',
                $mailConfig->getHost(), $mailConfig->getUsername(), $mailConfig->getPassword(), $mailConfig->getPort()));
            return new \Illuminate\Mail\Mailer('user.mailer', $this->app->get('view'), $transport, $this->app->get('events'));
        });

        URL::forceRootUrl(getenv('APP_URL'));
        URL::forceScheme("https");
        Schema::defaultStringLength(800);
        Queue::before(function (JobProcessing $event) {
            $payload = json_decode($event->job->getRawBody());
            $data = unserialize($payload->data->command);
            $jobIdentifier = $data->getJobIdentifier();
            try {
                MailQueue::query()->find($jobIdentifier)->update([
                    'status' => MailStatus::SENDING
                ]);
            } catch (Exception $exception) {
                Log::error($exception);
            }
        });

        Queue::after(function (JobProcessed $event) {
            $payload = json_decode($event->job->getRawBody());
            $data = unserialize($payload->data->command);
            $jobIdentifier = $data->getJobIdentifier();
            if (!$event->job->hasFailed()) {
                MailQueue::query()->find($jobIdentifier)->update([
                    'status' => MailStatus::SENT
                ]);
            }
        });
        Queue::failing(function (JobFailed $event) {
            $payload = json_decode($event->job->getRawBody());
            $data = unserialize($payload->data->command);
            $jobIdentifier = $data->getJobIdentifier();
            $message = $event->exception->getMessage();
            MailQueue::query()->find($jobIdentifier)->update([
                'status' => MailStatus::FAILED,
                'failure_cause' => $message,
            ]);
        });
    }
}
