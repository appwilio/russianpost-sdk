<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class NormalizeAddressRequest implements Arrayable
{
    use DataAware;

    public static function one(string $address): self
    {
        $request = new self();

        $request->addAddress(...\func_get_args());

        return $request;
    }

    public function addAddress(string $address): void
    {
        $this->data[] = [
            'id'               => \sha1($address),
            'original-address' => $address,
        ];
    }
}
