<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings;

use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings\Responses\ShippingPointsResponse;

final class Settings
{
    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function shippingPoints(): ShippingPointsResponse
    {
        return $this->client->get('/user-shipping-points', null, ShippingPointsResponse::class);
    }
}
