<?php

namespace App\Http\Controllers;

use App\ArrayHelper;
use App\Http\Requests\EditVariableRequest;
use App\Http\Requests\VariableRequest;
use App\Models\Project;
use App\Models\Variable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VariableController extends BaseController
{

    public function index(Project $project, Variable $variable = null): \Inertia\Response
    {
        return Inertia::render('Variables/Index', [
            'project' => $project,
            'variables' => $project->variables()->get(),
            'variable' => $variable
        ]);
    }

    public function store(VariableRequest $request, Project $project)
    {
        $validated = $request->validated();
        $validated['scope'] = ArrayHelper::getValueWithDotAnnotation($validated, 'scope.value');
        $project->variables()->create($validated);
        return Redirect::back();
    }

    public function update(EditVariableRequest $request, Project $project, Variable $variable)
    {
        $validated = $request->validated();
        $validated['scope'] = ArrayHelper::getValueWithDotAnnotation($validated, 'scope.value');
        $variable->update($validated);
        return Redirect::back();
    }

    public function delete(Project $project, Variable $variable): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $variable->delete();
        return Redirect::back();
    }

    public function search(Project $project, Request $request)
    {
        $query = $request->input('query');
        $variables = $project->variables()->where('key', 'like', "%$query%")->get();
        return response()->json($variables);
    }


}
