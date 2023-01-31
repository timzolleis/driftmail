<?php

namespace App\Http\Middleware;

use App\Models\entities\MailConfig;
use App\Models\Project;
use App\Models\ProjectConfiguration;
use App\Providers\MailServiceProvider;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class ApiAuthentication extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $apiKey = $request->header('x-api-key');
        if (!$apiKey) {
            return response([
                'error' => 'Failed to authorize: Authorization missing'
            ], 401);
        }
        $projectConfig = ProjectConfiguration::where('api_key', $apiKey)->first();
        $project = Project::where('id', $projectConfig->project_id)->first();
        if (!$project) {
            return response([
                'error' => 'Project not found!'
            ]);
        }
        Auth::loginUsingId($project->user_id);
        $app = App::getInstance();
        $app->register(MailServiceProvider::class);
        return $next($request);
    }
}
