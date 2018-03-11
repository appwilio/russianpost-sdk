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

use Appwilio\RussianPostSDK\Dispatching\Responses\Tariff;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

class TariffTestCase extends TestCase
{

    public function testBase(): void
    {
        AnnotationRegistry::registerLoader('class_exists');
        $price = mt_rand(1000, 20000);
        $vat = mt_rand(1000, 20000);

        $serializer = SerializerBuilder::create()->build();
        $result = [
            'rate' => $price,
            'vat'  => $vat,
        ];

        $response = $serializer->deserialize(\json_encode($result), Tariff::class, 'json');
        /** @var Tariff $response */

        $this->assertEquals($price/100, $response->getPrice());
        $this->assertEquals($vat/100, $response->getVat());
    }


}
