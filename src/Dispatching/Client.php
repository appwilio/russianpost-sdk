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

namespace Appwilio\RussianPostSDK\Dispatching;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    protected const API_URL = 'https://otpravka-api.pochta.ru/1.0/';

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    /** @var string */
    private $token;

    /** @var GuzzleClient */
    private $httpClient;

    public function __construct(string $login, string $password, string $token)
    {
        $this->login = $login;
        $this->password = $password;
        $this->token = $token;
    }

    protected function getHttpClient(): GuzzleClient
    {
        if (! $this->httpClient) {
            $this->httpClient = new GuzzleClient();
        }

        return $this->httpClient;
    }
}
