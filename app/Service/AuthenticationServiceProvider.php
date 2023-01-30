<?php

namespace App\Service;

interface AuthenticationServiceProvider
{

    public function authorize();
    public function getUser(string $code);

}
