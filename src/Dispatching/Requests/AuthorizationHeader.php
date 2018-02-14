<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

class AuthorizationHeader
{
    /** @var string */
    public $basicAuth;

    /** @var string */
    public $token;

    public function __construct(string $login, string $password, string $token)
    {
        $this->basicAuth = $this->basicAuth($login, $password);
        $this->token = $token;
    }

    public function basicAuth(string $login, string $password): string
    {
        return base64_encode($login . ":" . $password);
    }

    public function buildHeaders(): array
    {
        return
            [
                'Authorization'        => 'AccessToken ' . $this->token,
                'X-User-Authorization' => 'Basic ' . $this->basicAuth
            ];
    }
}
