<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

class AuthorizationHeader
{
    /** @var string */
    public $login;

    /** @var string */
    public $password;

    /** @var string */
    public $token;

    public function __construct(?string $login = null, ?string $password = null, ?string $token = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->token = $token;
    }

    public function basicAuth(): string
    {
        return base64_encode($this->login . ":" . $this->password);
    }
}
