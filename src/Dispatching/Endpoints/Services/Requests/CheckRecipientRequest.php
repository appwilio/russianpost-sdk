<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class CheckRecipientRequest implements Arrayable
{
    use DataAware;

    public static function create(): self
    {
        return new self();
    }

    public static function one(string $address, string $fullName, string $phone): self
    {
        $request = self::create();

        $request->addRecipient(...\func_get_args());

        return $request;
    }

    public function addRecipient(string $address, string $fullName, string $phone): void
    {
        $this->data[] = [
            'raw-address'   => $address,
            'raw-telephone' => $phone,
            'raw-full-name' => $fullName,
        ];
    }
}
