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
use Inertia\Inertia;

class TemplateController extends BaseController
{

    public function create(): \Inertia\Response
    {
        return Inertia::render('Template/Create');
    }

    public function store(CreateTemplateRequest $request)
    {
        $validated = $request->validated();
        Auth::user()->templates()->create(ArrayHelper::convertKeysToSnakeCase($validated));
        return redirect('/');
    }

    public function edit(Template $template): \Inertia\Response
    {
//        $template = Template::find($id);
        return Inertia::render('Template/Edit', [
            'template' => $template
        ]);
    }

    public function update(UpdateTemplateRequest $request, Template $template): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $template->update($validated);
        return redirect('/');

    }

    public function delete(Template $template): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $template->delete();
        return redirect('/');
    }


}
