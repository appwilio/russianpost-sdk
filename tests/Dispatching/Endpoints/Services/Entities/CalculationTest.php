<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Tests\Dispatching\Endpoints\Services\Entities;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Entities\Tariff;
use Appwilio\RussianPostSDK\Dispatching\Entities\DeliveryTime;
use Appwilio\RussianPostSDK\Dispatching\Enum\PaymentMethodType;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\Calculation;

class CalculationTest extends TestCase
{
    public function test_can_get_data(): void
    {
        /** @var Calculation $instance */
        $instance = Instantiator::instantiate(Calculation::class, [
            'payment-method'             => ($method = PaymentMethodType::CASHLESS()),
            'notice-payment-method'      => ($noticeMethod = PaymentMethodType::CASHLESS()),
            'delivery-time'              => ($delivery = ['min-days' => 2, 'max-days' => 10]),
            'with-fitting-rate'          => ($fittingRate = $this->buildTariffData()),
            'sms-notice-recipient-rate'  => ($smsRate = $this->buildTariffData()),
            'notice-rate'                => ($noticeRate = $this->buildTariffData()),
            'contents-checking-rate'     => ($contentRate = $this->buildTariffData()),
            'completeness-checking-rate' => ($completeRate = $this->buildTariffData()),
            'oversize-rate'              => ($oversizeRate = $this->buildTariffData()),
            'insurance-rate'             => ($insuranceRate = $this->buildTariffData()),
            'inventory-rate'             => ($inventoryRate = $this->buildTariffData()),
            'avia-rate'                  => ($aviaRate = $this->buildTariffData()),
            'ground-rate'                => ($groundRate = $this->buildTariffData()),
            'fragile-rate'               => ($fragileRate = $this->buildTariffData()),
            'vsd-rate'                   => ($vsdRate = $this->buildTariffData()),
            'total-rate'                 => ($totalRate = \random_int(100, 1000)),
            'total-vat'                  => ($totalVat = \random_int(100, 1000)),
        ]);

        $this->assertEquals($method, $instance->getPaymentMethod());
        $this->assertEquals($noticeMethod, $instance->getNoticePaymentMethod());

        $this->assertEquals($this->buildTariff($fittingRate), $instance->getFittingRate());
        $this->assertEquals($this->buildTariff($smsRate), $instance->getSmsNoticeRate());
        $this->assertEquals($this->buildTariff($noticeRate), $instance->getNoticeRate());
        $this->assertEquals($this->buildTariff($contentRate), $instance->getContentCheckingRate());
        $this->assertEquals($this->buildTariff($completeRate), $instance->getCompletenessCheckingRate());
        $this->assertEquals($this->buildTariff($oversizeRate), $instance->getOversizeRate());
        $this->assertEquals($this->buildTariff($insuranceRate), $instance->getInsuranceRate());
        $this->assertEquals($this->buildTariff($inventoryRate), $instance->getInventoryRate());
        $this->assertEquals($this->buildTariff($aviaRate), $instance->getAviaRate());
        $this->assertEquals($this->buildTariff($groundRate), $instance->getGroundRate());
        $this->assertEquals($this->buildTariff($fragileRate), $instance->getFragileRate());
        $this->assertEquals($this->buildTariff($vsdRate), $instance->getVsdRate());

        $this->assertEquals(Instantiator::instantiate(Tariff::class, [
            'rate' => $totalRate,
            'vat'  => $totalVat,
        ]), $instance->getTotalRate());
        $this->assertEquals($totalRate, $instance->getTotalRate()->getAmountWithoutVAT());
        $this->assertEquals($totalVat, $instance->getTotalRate()->getVAT());
        $this->assertEquals($totalRate + $totalVat, $instance->getTotalRate()->getAmountWithVAT());

        $this->assertEquals(Instantiator::instantiate(DeliveryTime::class, $delivery), $instance->getDeliveryTime());
        $this->assertEquals($delivery['min-days'], $instance->getDeliveryTime()->getMin());
        $this->assertEquals($delivery['max-days'], $instance->getDeliveryTime()->getMax());
    }

    private function buildTariffData(): array
    {
        return [
            'rate' => \random_int(100, 1000),
            'vat'  => \random_int(100, 400),
        ];
    }

    private function buildTariff(array $data): Tariff
    {
        return Instantiator::instantiate(Tariff::class, $data);
    }
}
