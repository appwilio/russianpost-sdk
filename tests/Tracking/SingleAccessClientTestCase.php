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

namespace Appwilio\RussianPostSDK\Tests\Tracking;

use PHPUnit\Framework\TestCase;
use Appwilio\RussianPostSDK\Tracking\SingleAccessClient;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Single\CashOnDeliveryResponse;
use Appwilio\RussianPostSDK\Tracking\Exceptions\SingleAccessException;

class SingleAccessClientTestCase extends TestCase
{
    public function test_client_is_instantiable(): void
    {
        $this->assertInstanceOf(
            SingleAccessClient::class,
            $this->createClient()
        );
    }

    public function test_can_get_tracking_url(): void
    {
        $this->assertEquals(
            'https://www.pochta.ru/tracking#RA644000001RU',
            $this->createClient()->getTrackingUrl('RA644000001RU')
        );
    }

    public function test_can_get_tracking_events(): void
    {
        ($soap = $this->mockSoap())->expects($this->once())
            ->method('__soapCall')
            ->with('getOperationHistory', $this->isType('array'), ...\array_fill(0, 3, $this->isNull()))
            ->willReturn(new TrackingResponse());

        $this->assertInstanceOf(
            TrackingResponse::class,
            $this->createClient($soap)->getTrackingEvents('RA644000001RU')
        );
    }

    public function test_can_get_cod_events(): void
    {
        ($soap = $this->mockSoap())->expects($this->once())
            ->method('__soapCall')
            ->with('PostalOrderEventsForMail', $this->isType('array'), ...\array_fill(0, 3, $this->isNull()))
            ->willReturn(new CashOnDeliveryResponse());

        $this->assertInstanceOf(
            CashOnDeliveryResponse::class,
            $this->createClient($soap)->getCashOnDeliveryEvents('RA644000001RU')
        );
    }

    public function test_exception_thrown_on_soap_fault(): void
    {
        $this->expectExceptionMessage('error');
        $this->expectException(SingleAccessException::class);

        ($soap = $this->mockSoap())->expects($this->once())
            ->method('__soapCall')
            ->will($this->throwException(new \SoapFault('error_code', 'error_message')));

        $this->createClient($soap)->getTrackingEvents('RA644000001RU');
    }

    public function test_exception_thrown_on_soap_fault_with_detail(): void
    {
        $this->expectExceptionMessage('one: one_error');
        $this->expectException(SingleAccessException::class);

        ($soap = $this->mockSoap())->expects($this->once())
            ->method('__soapCall')
            ->will($this->throwException(new \SoapFault('error', 'error', null, (object) ['one' => 'one_error'])));

        $this->createClient($soap)->getTrackingEvents('RA644000001RU');
    }

    private function createClient($soap = null)
    {
        return new class($soap ?? $this->mockSoap()) extends SingleAccessClient {
            public function __construct($mock)
            {
                parent::__construct('foo', 'bar');

                $this->client = $mock;
            }
        };
    }

    private function mockSoap()
    {
        return $this->getMockBuilder(\SoapClient::class)
            ->setMethods(['__soapCall'])
            ->disableOriginalConstructor()
            ->getMock();
    }
}
