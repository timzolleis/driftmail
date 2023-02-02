<?php

namespace App\Http\Controllers;

use App\ArrayHelper;
use App\Http\Requests\EditVariableRequest;
use App\Http\Requests\VariableRequest;
use App\Models\Project;
use App\Models\Variable;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VariableController extends BaseController
{

    public function index(Project $project)
    {
        return Inertia::render('Variables/Index', [
            'project' => $project,
            'variables' => $project->variables()->get()
        ]);
    }

    public function store(VariableRequest $request, Project $project)
    {
        $validated = $request->validated();
        $validated['scope'] = ArrayHelper::getValueWithDotAnnotation($validated, 'scope.value');
        $project->variables()->create($validated);
    }

    public function update(EditVariableRequest $request, Project $project, Variable $variable)
    {
        $validated = $request->validated();
        $validated['scope'] = ArrayHelper::getValueWithDotAnnotation($validated, 'scope.value');
        $variable->update($validated);
        return Redirect::back();
    }

    public function delete(string $id): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Variable::destroy($id);
        return redirect('/');
    }


}
