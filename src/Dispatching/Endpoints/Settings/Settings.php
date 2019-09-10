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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings;

use Appwilio\RussianPostSDK\Dispatching\Http\ArrayOf;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings\Responses\ShippingPoint;

final class Settings
{
    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function shippingPoints(): iterable
    {
        return $this->client->get('/1.0/user-shipping-points', null, new ArrayOf(ShippingPoint::class));
    }
}
