<?php

namespace App\Http\Controllers;

use App\ArrayHelper;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\ProjectConfiguration;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProjectConfigController extends BaseController
{


    public function index(): \Inertia\Response
    {

        return Inertia::render('Index', [
            'projects' => Project::all()
        ]);
    }


    public function create(): \Inertia\Response
    {
        return Inertia::render('Project/Create');

    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handleCreate(CreateProjectRequest $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Auth::user()->projects()->create($request->validated());
        return redirect('/');
    }


    public function edit(Project $project): \Inertia\Response
    {
        return Inertia::render('Project/Edit', [
            'project' => $project
        ]);
    }

    public function handleEdit(Project $project, EditProjectRequest $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $project->update($request->validated());
        return redirect('/');
    }

    public function delete(Project $project): \Illuminate\Http\RedirectResponse
    {
        $project->delete();
        return redirect('/');
    }

}
