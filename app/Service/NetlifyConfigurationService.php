<?php

namespace App\Service;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class NetlifyConfigurationService
{


    public function fetchConfiguration()
    {
        $endpoint = $this->constructEnvEndpoint();
        print_r($endpoint);
        $response = Http::withToken(env('NETLIFY_ACCESS_TOKEN'))->get($this->constructEnvEndpoint(), [
            'site_id' => env('NETLIFY_SITE_ID')
        ]);
        $this->parseConfigurationBody($response);

    }


    private function constructEnvEndpoint(): string
    {
        $envEndpoint = env('NETLIFY_ENV_ENDPOINT');
        $accountId = env('NETLIFY_USER_ID');
        $accountEndpoint = env('NETLIFY_ACCOUNT_ENDPOINT');
        $endpoint = "$accountEndpoint/$accountId/$envEndpoint";
        return $this->constructEndpoint($endpoint);

    }


    private function constructEndpoint(string $endpoint): string
    {
        $baseUrl = env('NETLIFY_BASE_URL');
        return "$baseUrl/$endpoint";
    }


    private function parseConfigurationBody(Response $response)
    {
        $jsonArray = $response->json();
        $variableArray = [];
        foreach ($jsonArray as $variable) {
            $key = $variable['key'];
            $value = $variable['values'][0];
            $variableArray[$key] = $value;
    }
//        echo "<pre>";
//        print_r($variableArray);
//        echo "</pre>";

        foreach ($variableArray as $variable) {
            print_r($variable['value']);


        }

    }

    private function checkConfigurationParameters()
    {

    }


}
