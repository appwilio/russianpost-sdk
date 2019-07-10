<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class CalculationResponse
{
    /**
     * @JMS\SerializedName("avia-rate")
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Tariff")
     * @var Tariff|null
     */
    private $aviaRate;

    /**
     * @JMS\SerializedName("ground-rate")
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Tariff")
     * @var Tariff|null
     */
    private $groundRate;

    /**
     * @JMS\SerializedName("fragile-rate")
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Tariff")
     * @var Tariff|null
     */
    private $fragileRate;

    /**
     * @JMS\SerializedName("insurance-rate")
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Tariff")
     * @var Tariff|null
     */
    private $insuranceRate;

    /**
     * @JMS\SerializedName("oversize-rate")
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Tariff")
     * @var Tariff|null
     */
    private $oversizeRate;

    /**
     * @JMS\SerializedName("completeness-checking-rate")
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Tariff")
     * @var Tariff|null
     */
    private $completenessCheckingRate;

    /**
     * @JMS\SerializedName("notice-rate")
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Tariff")
     * @var Tariff|null
     */
    private $noticeRate;

    /**
     * @JMS\SerializedName("sms-notice-recipient-rate")
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Tariff")
     * @var Tariff|null
     */
    private $smsNoticeRate;

    /**
     * @JMS\SerializedName("delivery-time")
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\DeliveryTime")
     * @var DeliveryTime
     */
    private $deliveryTime;

    /**
     * @JMS\SerializedName("total-rate")
     * @JMS\Type("int")
     */
    private $totalCost;

    /**
     * @JMS\SerializedName("total-vat")
     * @JMS\Type("int")
     */
    private $totalVat;

    public function getTotal(): Tariff
    {
        return new Tariff($this->totalCost, $this->totalVat);
    }

    public function getDeliveryTime(): DeliveryTime
    {
        return $this->deliveryTime;
    }

    public function getSmsNoticeRate(): ?Tariff
    {
        return $this->smsNoticeRate;
    }

    public function getNoticeRate(): ?Tariff
    {
        return $this->noticeRate;
    }

    public function getCompletenessCheckingRate(): ?Tariff
    {
        return $this->completenessCheckingRate;
    }

    public function getOversizeRate(): ?Tariff
    {
        return $this->oversizeRate;
    }

    public function getInsuranceRate(): ?Tariff
    {
        return $this->insuranceRate;
    }

    public function getAviaRate(): ?Tariff
    {
        return $this->aviaRate;
    }

    public function getGroundRate(): ?Tariff
    {
        return $this->groundRate;
    }

    public function getFragileRate(): ?Tariff
    {
        return $this->fragileRate;
    }
}
