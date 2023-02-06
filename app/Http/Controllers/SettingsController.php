<?php

namespace App\Http\Controllers;

use App\ArrayHelper;
use App\Http\Requests\CreateTemplateRequest;
use App\Http\Requests\SettingsRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Http\Requests\VariableRequest;
use App\Models\Project;
use App\Models\Template;
use App\Models\Variable;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingsController extends BaseController
{

    public function index(Project $project)
    {
        return Inertia::render('Settings/Index', ['settings' => $project->settings()->get()->first(), 'project' => $project]);
    }

    public function storeOrCreate(SettingsRequest $request, Project $project)
    {
        $validated = $request->validated();
        $project->settings()->updateOrCreate(['project_id' => $project->id], ArrayHelper::convertKeysToSnakeCase($validated));
        return Redirect::back();
    }

    public function export(Project $project)
    {
        $settings = $project->settings()->get();
        $settings->makeHidden(['api_key', 'mail_password']);
        $templates = $project->templates()->get();
        $variables = $project->variables()->get();

        $projectJSON = [
            'project' => $project,
            'templates' => $templates,
            'variables' => $variables,
            'settings' => $settings
        ];

       $fileName = $project->name;
        return response()->streamDownload(function () use ($projectJSON) {
           echo json_encode($projectJSON);
        }, "$fileName.json");
    }


    public function delete(Project $project, Template $template): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $template->delete();
        return Redirect::back();
    }


}
