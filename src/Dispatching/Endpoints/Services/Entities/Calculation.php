<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Entities\Tariff;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Entities\DeliveryTime;

final class Calculation implements Arrayable
{
    use DataAware;

    public function getPaymentMethod(): string
    {
        return $this->get('payment-method');
    }

    public function getNoticePaymentMethod(): string
    {
        return $this->get('notice-payment-method');
    }

    public function getDeliveryTime(): ?DeliveryTime
    {
        return Instantiator::instantiate(DeliveryTime::class, $this->get('delivery-time'));
    }

    public function getSmsNoticeRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('sms-notice-recipient-rate'));
    }

    public function getNoticeRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('notice-rate'));
    }

    public function getCompletenessCheckingRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('completeness-checking-rate'));
    }

    public function getContentCheckingRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('content-checking-rate'));
    }

    public function getOversizeRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('oversize-rate'));
    }

    public function getInsuranceRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('insurance-rate'));
    }

    public function getInventoryRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('inventory-rate'));
    }

    public function getAviaRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('avia-rate'));
    }

    public function getGroundRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('ground-rate'));
    }

    public function getFragileRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('fragile-rate'));
    }

    public function getVsdRate(): ?Tariff
    {
        return Instantiator::instantiate(Tariff::class, $this->get('vsd-rate'));
    }

    public function getTotalRate(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('total-rate'),
            'vat' => $this->get('total-vat'),
        ]);
    }
}
