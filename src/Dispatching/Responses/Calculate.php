<?php
/**
 * This file is part of russianpost-sdk package.
 *
 * @author Anton Kartsev <anton@alarm.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Responses;

use JMS\Serializer\Annotation AS JMS;

class Calculate
{
    /**
     * @JMS\Type("float")
     * @JMS\SerializedName("total-rate")
     *
     * @var float
     */
    protected $totalPrice;

    /**
     * @JMS\Type("float")
     * @JMS\SerializedName("total-vat")
     *
     * @var float
     */
    protected $totalVat;

    /**
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Responses\DeliveryTime")
     * @JMS\SerializedName("delivery-time")
     *
     * @var \Appwilio\RussianPostSDK\Dispatching\Responses\DeliveryTime|null
     */
    protected $deliveryTime;

    /**
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Responses\Tariff")
     * @JMS\SerializedName("avia-rate")
     *
     * @var \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    protected $avia;

    /**
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Responses\Tariff")
     * @JMS\SerializedName("ground-rate")
     *
     * @var \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    protected $ground;

    /**
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Responses\Tariff")
     * @JMS\SerializedName("fragile-rate")
     *
     * @var \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    protected $fragile;

    /**
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Responses\Tariff")
     * @JMS\SerializedName("insurance-rate")
     *
     * @var \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    protected $insurance;

    /**
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Responses\Tariff")
     * @JMS\SerializedName("notice-rate")
     *
     * @var \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    protected $notice;

    /**
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Responses\Tariff")
     * @JMS\SerializedName("oversize-rate")
     *
     * @var \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    protected $oversize;

    /**
     * Плата всего, руб
     *
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice/100;
    }

    /**
     * Всего НДС, руб
     *
     * @return float
     */
    public function getTotalVat(): float
    {
        return $this->totalVat/100;
    }

    /**
     * @return \Appwilio\RussianPostSDK\Dispatching\Responses\DeliveryTime|null
     */
    public function getDeliveryTime(): ?\Appwilio\RussianPostSDK\Dispatching\Responses\DeliveryTime
    {
        return $this->deliveryTime;
    }

    /**
     * Плата за Авиа-пересылку
     *
     * @return \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    public function getAvia(): ?Tariff
    {
        return $this->avia;
    }

    /**
     * Надбавка за отметку 'Осторожно/Хрупкое'
     *
     * @return \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    public function getGround(): ?Tariff
    {
        return $this->ground;
    }

    /**
     * Плата за пересылку
     *
     * @return \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    public function getFragile(): ?Tariff
    {
        return $this->fragile;
    }

    /**
     * Плата за объявленную ценность
     *
     * @return \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    public function getInsurance(): ?Tariff
    {
        return $this->insurance;
    }

    /**
     * Надбавка за уведомление о вручении
     *
     * @return \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    public function getNotice(): ?Tariff
    {
        return $this->notice;
    }

    /**
     * Надбавка за негабарит при весе более 10кг
     *
     * @return \Appwilio\RussianPostSDK\Dispatching\Responses\Tariff|null
     */
    public function getOversize(): ?Tariff
    {
        return $this->oversize;
    }
}
