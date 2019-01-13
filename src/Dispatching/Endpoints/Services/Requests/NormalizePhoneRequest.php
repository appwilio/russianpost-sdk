<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests;

use Appwilio\RussianPostSDK\Dispatching\Http\ApiRequest;

final class NormalizePhoneRequest extends ApiRequest
{
    private $items = [];

    public static function one(string $phone, ?string $area = null, ?string $place = null, ?string $region = null): self
    {
        $request = new self();

        $request->addPhone(...\func_get_args());

        return $request;
    }

    public function addPhone(string $phone, ?string $area = null, ?string $place = null, ?string $region = null): void
    {
        $this->items[] = \array_merge(
            [
                'id'             => \sha1($phone),
                'original-phone' => $phone
            ],
            \array_filter(\compact('area', 'place', 'region'))
        );
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
