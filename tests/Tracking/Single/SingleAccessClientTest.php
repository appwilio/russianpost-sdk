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

namespace Appwilio\RussianPostSDK\Tests\Tracking\Single;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Tests\Tracking\MockSoap;
use Appwilio\RussianPostSDK\Tracking\SingleAccessClient;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEvent;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventsWrapper;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventsResponse;
use Appwilio\RussianPostSDK\Tracking\Single\CashOnDeliveryEvent;
use Appwilio\RussianPostSDK\Tracking\Single\CashOnDeliveryEventsResponse;
use Appwilio\RussianPostSDK\Tracking\Exceptions\SingleAccessException;
use Appwilio\RussianPostSDK\Tracking\Single\CashOnDeliveryEventsWrapper;

class SingleAccessClientTest extends TestCase
{
    use MockSoap;

    public function test_client_is_instantiable(): void
    {
        $this->assertInstanceOf(SingleAccessClient::class, $this->createClient());
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
        $response = $this->buildClass(TrackingEventsResponse::class, [
            'OperationHistoryData' => $this->buildClass(TrackingEventsWrapper::class, [
                'historyRecord' => [
                    $this->buildClass(TrackingEvent::class),
                    $this->buildClass(TrackingEvent::class),
                ],
            ]),
        ]);

        $this->soapMock
            ->with('getOperationHistory', $this->isType('array'))
            ->willReturn($response);

        $trackingResponse = $this->createClient()->getTrackingEvents('RA644000001RU');

        $this->assertInstanceOf(TrackingEventsResponse::class, $trackingResponse);

        $this->assertInstanceOf(TrackingEventsResponse::class, $trackingResponse);
        $this->assertInstanceOf(\Traversable::class, $trackingResponse->getIterator());

        foreach ($trackingResponse as $operation) {
            $this->assertInstanceOf(TrackingEvent::class, $operation);
        }
    }

    public function test_can_get_cod_events(): void
    {
        $this->soapMock
            ->with('PostalOrderEventsForMail', $this->isType('array'))
            ->willReturn($this->buildClass(CashOnDeliveryEventsResponse::class, [
                'PostalOrderEventsForMaiOutput' => $this->buildClass(CashOnDeliveryEventsWrapper::class, [
                    'PostalOrderEvent' => [
                        $this->buildClass(CashOnDeliveryEvent::class),
                        $this->buildClass(CashOnDeliveryEvent::class),
                    ],
                ]),
            ]));

        $response = $this->createClient()->getCashOnDeliveryEvents('RA644000001RU');

        $this->assertInstanceOf(CashOnDeliveryEventsResponse::class, $response);

        $this->assertInstanceOf(\Traversable::class, $response->getIterator());

        foreach ($response as $event) {
            $this->assertInstanceOf(CashOnDeliveryEvent::class, $event);
        }
    }

    public function test_can_get_cod_events_as_array_if_one_event_provided(): void
    {
        $this->soapMock
            ->with('PostalOrderEventsForMail', $this->isType('array'))
            ->willReturn($this->buildClass(CashOnDeliveryEventsResponse::class, [
                'PostalOrderEventsForMaiOutput' => $this->buildClass(CashOnDeliveryEventsWrapper::class, [
                    'PostalOrderEvent' => $this->buildClass(CashOnDeliveryEvent::class),
                ]),
            ]));

        $response = $this->createClient()->getCashOnDeliveryEvents('RA644000001RU');

        $this->assertInstanceOf(CashOnDeliveryEventsResponse::class, $response);

        $this->assertInstanceOf(\Traversable::class, $response->getIterator());

        $this->assertCount(1, $response->getEvents());

        foreach ($response as $event) {
            $this->assertInstanceOf(CashOnDeliveryEvent::class, $event);
        }
    }

    public function test_exception_thrown_on_empty_tracking_response(): void
    {
        $this->expectException(SingleAccessException::class);

        $response = $this->buildClass(TrackingEventsResponse::class, [
            'OperationHistoryData' => $this->buildClass(TrackingEventsWrapper::class, [
                'historyRecord' => [],
            ]),
        ]);

        $this->soapMock
            ->with('getOperationHistory', $this->isType('array'))
            ->willReturn($response);

        $this->createClient()->getTrackingEvents('RA644000001RU');
    }

    public function test_exception_thrown_on_empty_cod_response(): void
    {
        $this->expectException(SingleAccessException::class);

        $this->soapMock
            ->with('PostalOrderEventsForMail', $this->isType('array'))
            ->willReturn($this->buildClass(CashOnDeliveryEventsResponse::class, [
                'PostalOrderEventsForMaiOutput' => $this->buildClass(CashOnDeliveryEventsWrapper::class, [
                    'PostalOrderEvent' => [],
                ]),
            ]));

        $this->createClient()->getCashOnDeliveryEvents('RA644000001RU');
    }

    public function test_exception_thrown_on_soap_fault(): void
    {
        $this->expectExceptionMessage('error');
        $this->expectException(SingleAccessException::class);

        $this->soapMock
            ->will($this->throwException(new \SoapFault('error_code', 'error_message')));

        $this->createClient()->getTrackingEvents('RA644000001RU');
    }

    public function test_exception_thrown_on_soap_fault_with_detail(): void
    {
        $this->expectExceptionMessage('one: one_error');
        $this->expectException(SingleAccessException::class);

        $this->soapMock
            ->will($this->throwException(new \SoapFault('error', 'error', null, (object) ['one' => 'one_error'])));

        $this->createClient()->getTrackingEvents('RA644000001RU');
    }

    private function createClient()
    {
        return new class($this->soapClient) extends SingleAccessClient {
            public function __construct($mock)
            {
                parent::__construct('foo', 'bar');

                $this->client = $mock;
            }
        };
    }
}
