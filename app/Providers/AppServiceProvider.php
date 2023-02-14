<?php

namespace App\Providers;

use App\Models\MailQueue;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use PHPUnit\Framework\MockObject\Exception;

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
        Schema::defaultStringLength(800);

        Queue::before(function (JobProcessing $event) {
            $payload = json_decode($event->job->getRawBody());
            $data = unserialize($payload->data->command);
            $jobIdentifier = $data->getJobIdentifier();
            Log::debug($jobIdentifier);
            try {
                MailQueue::query()->find($jobIdentifier)->update([
                    'status' => 'sending'
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
                    'status' => 'sent'
                ]);
            }
        });

        Queue::failing(function (JobFailed $event) {
            $payload = json_decode($event->job->getRawBody());
            $data = unserialize($payload->data->command);
            $jobIdentifier = $data->getJobIdentifier();
            $message = $event->exception->getMessage();
            MailQueue::query()->find($jobIdentifier)->update([
                'status' => "failed: $message"
            ]);
        });
    }
}
