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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Requests;

use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class FindByAddressRequest implements Arrayable
{
    /** @var array */
    private $data;

    public static function create(string $address, int $take = 3): self
    {
        return new self($address, $take);
    }

    public function __construct(string $address, int $take = 3)
    {
        $this->data = [
            'top'     => $take,
            'address' => $address,
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
