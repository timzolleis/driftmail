<?php

namespace App\Models\custom;

class NetlifyAuthConfiguration
{
    protected string $authenticationUrl;
    protected string $authenticationTokenUrl;
    protected string $redirectUri;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct(string $authenticationUrl, string $authenticationTokenUrl, string $redirectUri, string $clientId, string $clientSecret)
    {
        $this->authenticationUrl = $authenticationUrl;
        $this->authenticationTokenUrl = $authenticationTokenUrl;
        $this->redirectUri = $redirectUri;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     */
    public function getAuthenticationUrl(): string
    {
        return $this->authenticationUrl;
    }

    /**
     * @return string
     */
    public function getAuthenticationTokenUrl(): string
    {
        return $this->authenticationTokenUrl;
    }

    /**
     * @return string
     */
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

}
