<?php

namespace App\Http\Controllers\api;

use App\Service\NetlifyConfigurationService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class MailController extends BaseController
{
    use DispatchesJobs;

    protected NetlifyConfigurationService $netlifyConfigurationService;

    public function __construct(NetlifyConfigurationService $netlifyConfigurationService)
    {
        $this->netlifyConfigurationService = $netlifyConfigurationService;
    }

    public function send()
    {
        $this->netlifyConfigurationService->fetchConfiguration();
    }


    public function getStatus()
    {

    }


}
