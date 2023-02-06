<?php

namespace App\Http\Middleware;

use App\Exceptions\api\ApiAuthenticationFailedException;
use App\Exceptions\api\project\ProjectNotFoundException;
use App\Models\entities\MailConfig;
use App\Models\Project;
use App\Models\ProjectConfiguration;
use App\Models\ProjectSettings;
use App\Providers\MailServiceProvider;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class SetProjectId extends Middleware
{
    /**
     * @throws ApiAuthenticationFailedException
     * @throws \Throwable
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $apiKey = $request->header('x-api-key');
        throw_if(!$apiKey, new ApiAuthenticationFailedException('Authorization missing', 401));
        $projectConfig = ProjectSettings::query()->where('api_key', $apiKey)->first();
        throw_if(!$projectConfig, new ApiAuthenticationFailedException('Api key did not match. Check for typos!', 400));
        $request->attributes->add(['project_id' => $projectConfig->project_id]);
        return $next($request);
    }
}
