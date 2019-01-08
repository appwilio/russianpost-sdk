<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings;

use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;

final class Settings
{
    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function points()
    {
        
    }

    public function settings()
    {
        
    }
}
