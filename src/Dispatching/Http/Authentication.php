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

use Psr\Http\Message\RequestInterface;

final class Authentication
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

    public function authenticate(RequestInterface $request): RequestInterface
    {
        return $request
            ->withHeader('Authorization', "AccessToken {$this->token}")
            ->withHeader('X-User-Authorization', "Basic {$this->basic}");
    }
}
