<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests;

use Appwilio\RussianPostSDK\Dispatching\Http\ApiRequest;

final class NormalizeFioRequest extends ApiRequest
{
    private $items = [];

    public static function one(string $fio): self
    {
        $request = new self();

        $request->addFio(...\func_get_args());

        return $request;
    }

    public function addFio(string $fio): void
    {
        $this->items[] = [
            'id'           => \sha1($fio),
            'original-fio' => $fio
        ];
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
