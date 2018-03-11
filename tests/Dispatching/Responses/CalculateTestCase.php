<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * @author Anton Kartsev <anton@alarm.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Dispatching;

use Appwilio\RussianPostSDK\Dispatching\Responses\Calculate;
use Appwilio\RussianPostSDK\Dispatching\Responses\CalculateResponse;
use Appwilio\RussianPostSDK\Dispatching\Responses\DeliveryTime;
use Appwilio\RussianPostSDK\Dispatching\Responses\Tariff;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

class CalculateTestCase extends TestCase
{

    public function testBase(): void
    {
        AnnotationRegistry::registerLoader('class_exists');
        $maxDays = mt_rand(5, 20);
        $minDays = mt_rand(1, 5);
        $tariffRate = mt_rand(1000, 20000);
        $tariffVat = mt_rand(1000, 20000);
        $totalRate = mt_rand(1000, 20000);
        $totalVat = mt_rand(1000, 20000);

        $serializer = SerializerBuilder::create()->build();
        $result = [
            'body' =>
                [
                    'delivery-time'  => [
                        'max-days' => $maxDays,
                        'min-days' => $minDays,
                    ],
                    'avia-rate'      =>
                        [
                            'rate' => $tariffRate,
                            'vat'  => $tariffVat,
                        ],
                    'fragile-rate'   =>
                        [
                            'rate' => $tariffRate,
                            'vat'  => $tariffVat,
                        ],
                    'ground-rate'    =>
                        [
                            'rate' => $tariffRate,
                            'vat'  => $tariffVat,
                        ],
                    'insurance-rate' =>
                        [
                            'rate' => $tariffRate,
                            'vat'  => $tariffVat,
                        ],
                    'notice-rate'    =>
                        [
                            'rate' => $tariffRate,
                            'vat'  => $tariffVat,
                        ],
                    'oversize-rate'  =>
                        [
                            'rate' => $tariffRate,
                            'vat'  => $tariffVat,
                        ],
                    'total-rate'     => $totalRate,
                    'total-vat'      => $totalVat,
                ],
        ];

        $response = $serializer->deserialize(\json_encode($result), CalculateResponse::class, 'json');
        /** @var $response CalculateResponse */
        $calculate = $response->getCalculate();

        $this->assertInstanceOf(Calculate::class, $calculate);
        $this->assertInstanceOf(Tariff::class, $calculate->getAvia());
        $this->assertInstanceOf(Tariff::class, $calculate->getFragile());
        $this->assertInstanceOf(Tariff::class, $calculate->getGround());
        $this->assertInstanceOf(Tariff::class, $calculate->getInsurance());
        $this->assertInstanceOf(Tariff::class, $calculate->getNotice());
        $this->assertInstanceOf(Tariff::class, $calculate->getOversize());
        $this->assertInstanceOf(DeliveryTime::class, $calculate->getDeliveryTime());
        $this->assertEquals($totalRate/100, $calculate->getTotalPrice());
        $this->assertEquals($totalVat/100, $calculate->getTotalVat());
    }


}
