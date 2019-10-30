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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Responses;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class Service implements Arrayable
{
    use DataAware;

    public function getCode(): string
    {
        return $this->get('code');
    }

    public function getGroupId(): int
    {
        return $this->get('group-id');
    }

    public function getName(): string
    {
        return $this->get('name');
    }
}
