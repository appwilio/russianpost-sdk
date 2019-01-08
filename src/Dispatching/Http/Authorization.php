<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Http;

final class Authorization
{
    /** @var string */
    public $token;

    /** @var string */
    public $basic;

    public function __construct(string $login, string $password, string $token)
    {
        $this->token = $token;

        $this->basic = \base64_encode("{$login}:{$password}");
    }

    public function toArray(): array
    {
        return [
            'Authorization'        => "AccessToken {$this->token}",
            'X-User-Authorization' => "Basic {$this->basic}"
        ];
    }
}
