<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Entities;

final class Tariff
{
    private $data;

    /**
     * Стоимость без НДС в копейках. (rate).
     *
     * @return int
     */
    public function getAmountWithoutVAT(): int
    {
        return $this->data['rate'];
    }

    /**
     * Стоимость с НДС в копейках.
     *
     * @return int
     */
    public function getAmountWithVAT(): int
    {
        return $this->getAmountWithoutVAT() + $this->getVAT();
    }

    /**
     * НДС в копейках (vat).
     *
     * @return int
     */
    public function getVAT(): int
    {
        return $this->data['vat'];
    }
}
