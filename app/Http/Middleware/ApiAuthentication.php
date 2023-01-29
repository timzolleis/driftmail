<?php

namespace App\Http\Middleware;

use App\Models\entities\MailConfig;
use App\Models\Project;
use App\Models\ProjectConfiguration;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class ApiAuthentication extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {

        $apiKey = $request->header('x-api-key');
        if(!$apiKey){
            return response([
                'error' => 'Failed to authorize: Authorization missing'
            ], 401);
        }
        $projectConfig = ProjectConfiguration::where('api_key', $apiKey)->first();
        if (!$projectConfig) {
           return response([
               'error' => 'Failed to authorize: incorrect api-key'
           ], 401);
        }
        $project = Project::where('id', $projectConfig->project_id)->first();
        Auth::loginUsingId($project->netlify_user_id);
        $mailConfig = MailConfig::getFromProjectConfiguration($projectConfig);
        Config::set('mail', $mailConfig->getConfigurationArray());
        $app = App::getInstance();
        $app->register('Illuminate\Mail\MailServiceProvider');
        return $next($request);
    }
}
