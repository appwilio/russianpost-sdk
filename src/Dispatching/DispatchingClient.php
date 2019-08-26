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

use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Http\Authorization;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Services;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings\Settings;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Documents\Documents;

final class DispatchingClient
{
    /** @var ApiClient */
    private $client;

    public function __construct(string $login, string $password, string $token, array $httpOptions = [])
    {
        $this->client = new ApiClient(new Authorization($login, $password, $token), $httpOptions);
    }

    public function orders()
    {

    }

    public function batches()
    {
        //
    }

    public function documents(): Documents
    {
        return new Documents($this->client);
    }

    public function archive()
    {
        //
    }

    public function postoffices()
    {
        
    }

    public function services(): Services
    {
        return new Services($this->client);
    }

    public function settings()
    {
        return new Settings($this->client);
    }
}
