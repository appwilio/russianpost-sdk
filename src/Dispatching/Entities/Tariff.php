<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Entities;

final class Tariff
{
    private $data;

    /**
     * Стоимость услуги без НДС в копейках. (rate).
     *
     * @return int
     */
    public function getRate(): int
    {
        return $this->data['rate'];
    }

    /**
     * Сумма НДС в копейках (vat).
     *
     * @return int
     */
    public function getVAT(): int
    {
        return $this->data['vat'];
    }

    /**
     * Стоимость услуги с НДС в копейках.
     *
     * @return int
     */
    public function getRateWithVAT(): int
    {
        return $this->getRate() + $this->getVAT();
    }
}
