<?php

namespace App\Http\Controllers;

use App\ArrayHelper;
use App\Http\Requests\CreateTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Http\Requests\VariableRequest;
use App\Models\Project;
use App\Models\Template;
use App\Models\Variable;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TemplateController extends BaseController
{

    public function index(Project $project)
    {
        return Inertia::render('Template/Index', ['templates' => $project->templates()->get()]);
    }

    public function store(CreateTemplateRequest $request, Project $project)
    {
        $validated = $request->validated();
        $project->templates()->create($validated);
        return Redirect::back();
    }

    public function edit(Template $template): \Inertia\Response
    {
//        $template = Template::find($id);
        return Inertia::render('Template/Edit', [
            'template' => $template
        ]);
    }

    public function update(UpdateTemplateRequest $request, Project $project, Template $template): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $template->update($validated);
        return Redirect::back();

    }

    public function delete(Project $project, Template $template): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $template->delete();
        return Redirect::back();
    }


}
