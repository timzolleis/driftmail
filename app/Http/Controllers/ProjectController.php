<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Project;
use App\Service\FormService;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ProjectController extends BaseController
{

    protected FormService $formService;

    /**
     * @param FormService $formService
     */
    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }


    public function index(): \Inertia\Response
    {
        return Inertia::render('Index', [
            'projects' => Project::all()
        ]);
    }


    public function create()
    {
        return Inertia::render('Project/Create');

    }

    public function handleCreate(CreateProjectRequest $request)
    {
        $inputFields = $this->formService->getProjectCreationFormFields($request);
        $project = Project::create([
            'name' => $inputFields['name'],
            'description' => $inputFields['description'],
            'active' => true
        ]);
        $configuration = $project->config()->create([
            'api_key' => $inputFields['api_key'],
            'mail_host' => $inputFields['mail_host'],
            'mail_port' => $inputFields['mail_port'],
            'mail_user' => $inputFields['mail_user'],
            'mail_password' => $inputFields['mail_password'],
            'mail_sending_address' => $inputFields['mail_sending_address'],
            'mail_test_receiver' => $inputFields['mail_test_receiver']
        ]);

        return redirect('/');
    }


}
