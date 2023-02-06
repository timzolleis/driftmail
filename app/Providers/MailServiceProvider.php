<?php

namespace App\Providers;

use App\Models\entities\MailConfig;
use App\Models\ProjectConfiguration;
use App\Models\ProjectSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $apiKey = $this->app->request->header('x-api-key');
        $projectConfig = ProjectSettings::where('api_key', $apiKey)->first();
        $mailConfig = MailConfig::getFromProjectConfiguration($projectConfig);
        Config::set('mail', $mailConfig->getConfigurationArray());
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
