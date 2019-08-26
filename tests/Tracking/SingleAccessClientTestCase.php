<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Tests\Tracking;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Appwilio\RussianPostSDK\Tracking\SingleAccessClient;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Single\CashOnDeliveryResponse;

class SingleAccessClientTestCase extends TestCase
{
    public function test_client_is_instantiable(): void
    {
        Assert::assertInstanceOf(
            SingleAccessClient::class,
            $this->getClient()
        );
    }

    public function test_can_get_tracking_events(): void
    {
        Assert::assertInstanceOf(
            TrackingResponse::class,
            $this->getClient()->getTrackingEvents('29500098765432')
        );
    }

    public function test_can_get_cod_events(): void
    {
        Assert::assertInstanceOf(
            CashOnDeliveryResponse::class,
            $this->getClient()->getCashOnDeliveryEvents('29500098765432')
        );
    }

    private function getClient()
    {
        $mock = $this->createSoapClientMock();

        return new class($mock) extends SingleAccessClient
        {
            public function __construct($mock)
            {
                parent::__construct('foo', 'bar');

                $this->client = $mock;
            }
        };
    }

    private function createSoapClientMock(): \SoapClient
    {
        $mock = $this->getMockBuilder(\SoapClient::class)
            ->setMethods(['__soapCall'])
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('__soapCall')->willReturnCallback(static function ($method) {
            return ([
                'getOperationHistory'      => new TrackingResponse(),
                'PostalOrderEventsForMail' => new CashOnDeliveryResponse(),
            ])[$method];
        });

        /** @var \SoapClient $mock */
        return $mock;
    }
}
