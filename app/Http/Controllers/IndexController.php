<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class IndexController extends BaseController
{

    public function index(): \Inertia\Response
    {
        return Inertia::render('Index', [
            'projects' => Project::all()
        ]);
    }

}
