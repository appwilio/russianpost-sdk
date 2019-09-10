<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Entities;

final class Tariff
{
    private $data;

    public function getRate(): int
    {
        return $this->data['rate'];
    }

    public function getVat(): int
    {
        return $this->data['vat'];
    }
}
