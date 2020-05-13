<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites;

use Appwilio\RussianPostSDK\Core\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Enum\EcomService;
use Appwilio\RussianPostSDK\Dispatching\Enum\EcomIdentityMethod;

final class EcomData implements Arrayable
{
    use DataAware;

    public function __construct(string $id)
    {
        $this->data['delivery-point-index'] = $id;
    }

    public function withIdentityMethod(EcomIdentityMethod $method)
    {
        $this->data['identity-methods'][] = $method;

        return $this;
    }

    public function addService(EcomService $servcie)
    {
        $this->data['services'][] = $servcie;

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
