<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Http;

final class Authorization
{
    /** @var string */
    private $token;

    /** @var string */
    private $basic;

    public function __construct(string $login, string $password, string $token)
    {
        $this->token = $token;

        $this->basic = \base64_encode("{$login}:{$password}");
    }

    public function toArray(): array
    {
        return [
            'Authorization'        => "AccessToken {$this->token}",
            'X-User-Authorization' => "Basic {$this->basic}",
        ];
    }
}
