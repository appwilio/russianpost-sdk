<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class Tariff
{
    /**
     * @JMS\SerializedName("rate")
     * @JMS\Type("int")
     * @var int
     */
    private $cost;

    /**
     * @JMS\SerializedName("vat")
     * @JMS\Type("int")
     * @var int
     */
    private $vat;

    public function __construct(int $cost, int $vat)
    {
        $this->cost = $cost;
        $this->vat = $vat;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function getVat(): int
    {
        return $this->vat;
    }
}
