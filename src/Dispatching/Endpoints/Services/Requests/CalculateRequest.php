<?php

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests;

use Appwilio\RussianPostSDK\Dispatching\Http\ApiRequest;

final class CalculateRequest extends ApiRequest
{
    private $data = [];

    public static function create(string $to, int $weight): self
    {
        return new self(...\func_get_args());
    }

    public function __construct(string $to, int $weight)
    {
        $this->data['to'] = $to;
        $this->data['weight'] = $weight;
    }

    public function fragile(bool $value = true)
    {
        $this->data['fragile'] = $value;

        return $this;
    }

    public function toArray(): array
    {
        return \array_filter($this->data);
    }
}
