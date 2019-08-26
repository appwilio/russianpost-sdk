<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Http;

final class ArrayOf
{
    /** @var string */
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}