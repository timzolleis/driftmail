<?php

namespace App\Http\Controllers;

use App\ArrayHelper;
use App\Http\Requests\CreateProjectRequest;
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

class ProjectController extends BaseController
{


    public function index(Project $project): \Inertia\Response
    {
        return Inertia::render('Project/Index', [
            'project' => $project
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store(CreateProjectRequest $request)
    {
        Auth::user()->projects()->create($request->validated());
        return Redirect::back();
    }


    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        return Redirect::back();
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        Project::destroy($id);
        return redirect('/');
    }

}
