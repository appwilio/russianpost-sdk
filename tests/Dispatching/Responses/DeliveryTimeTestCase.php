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

use Appwilio\RussianPostSDK\Dispatching\Responses\DeliveryTime;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

class DeliveryTimeTestCase extends TestCase
{

    public function testBase(): void
    {
        AnnotationRegistry::registerLoader('class_exists');
        $minDays = mt_rand(1000, 20000);
        $maxDays = mt_rand(1000, 20000);

        $serializer = SerializerBuilder::create()->build();
        $result = [
            'min-days' => $minDays,
            'max-days' => $maxDays,
        ];

        $response = $serializer->deserialize(\json_encode($result), DeliveryTime::class, 'json');
        /** @var DeliveryTime $response */

        $this->assertEquals($minDays, $response->getMinDays());
        $this->assertEquals($maxDays, $response->getMaxDays());
    }
}
