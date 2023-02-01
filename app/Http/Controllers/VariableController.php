<?php

namespace App\Http\Controllers;

use App\ArrayHelper;
use App\Http\Requests\VariableRequest;
use App\Models\Project;
use App\Models\Variable;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class VariableController extends BaseController
{

    public function index(){
        return Inertia::render('Variables/Index');
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Variables/Create');
    }

    public function store(VariableRequest $request)
    {
        $validated = $request->validated();
        Auth::user()->variables()->create(ArrayHelper::convertKeysToSnakeCase($validated));
        return redirect('/');
    }

    public function edit(string $id): \Inertia\Response
    {
        $variable = Variable::find($id);
        return Inertia::render('Variables/Edit', [
            'variable' => $variable
        ]);
    }

    public function update(VariableRequest $request, string $id): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        Variable::find($id)->update($validated);
        return redirect('/');

    }

    public function delete(string $id): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Variable::destroy($id);
        return redirect('/');
    }


}
