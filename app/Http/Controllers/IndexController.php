<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IndexController extends BaseController
{

    public function index(): \Inertia\Response
    {
        return Inertia::render('Index', [
            'projects' => Auth::user()->projects()->with('config')->get()
        ]);
    }

}
