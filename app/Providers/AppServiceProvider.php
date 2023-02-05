<?php

namespace App\Providers;

use App\Models\MailQueue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
//        Queue::before(function (JobProcessing $event) {
//            MailQueue::where('job_id', $event->job->getJobId())->first()->update([
//                'status' => 'sending'
//            ]);
//
//        });
//
//        Queue::after(function (JobProcessed $event) {
//            MailQueue::where('job_id', $event->job->getJobId())->first()->update([
//                'status' => 'sent'
//            ]);
//
//        });
//    }
    }
}
