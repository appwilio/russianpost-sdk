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

namespace Appwilio\RussianPostSDK\Tests\Tracking\Packet;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Tracking\Packet\Item;
use Appwilio\RussianPostSDK\Tracking\Packet\Error;
use Appwilio\RussianPostSDK\Tracking\Packet\Wrapper;
use Appwilio\RussianPostSDK\Tests\Tracking\MockSoap;
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;
use Appwilio\RussianPostSDK\Tracking\Packet\TicketResponse;
use Appwilio\RussianPostSDK\Tracking\Packet\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Exceptions\PacketAccessException;

class PacketAccessClientTest extends TestCase
{
    use MockSoap;

    public function test_client_is_instantiable(): void
    {
        $this->assertInstanceOf(PacketAccessClient::class, $this->createClient());
    }

    public function test_can_get_ticket(): void
    {
        $this->soapMock
            ->with('getTicket', $this->isType('array'))
            ->willReturn($this->buildClass(TicketResponse::class, [
                'value' => ($ticketId = '20190101010101000FOO'),
            ]));

        $ticket = $this->createClient()->getTicket(['RA644000001RU']);

        $this->assertInstanceOf(TicketResponse::class, $ticket);
        $this->assertEquals($ticketId, $ticket->getId());
    }

    public function test_cannot_get_ticket_if_tracks_number_limit_exceeded(): void
    {
        $this->expectException(PacketAccessException::class);

        $source = (static function () {
            foreach (\range(1, 3001) as $item) {
                yield \sprintf('2950009876%04d', $item);
            }
        })();

        $this->createClient()->getTicket($source);
    }

    public function test_can_get_tracking_events(): void
    {
        $response = $this->buildClass(TrackingResponse::class, [
            'value' => $this->buildClass(Wrapper::class, [
                'DatePreparation' => ($preparedAt = '02.01.2019 01:02:03'),
                'Item'            => $this->buildClass(Item::class),
            ]),
        ]);

        $this->soapMock->with('getResponseByTicket', $this->isType('array'))->willReturn($response);

        $trackingResponse = $this->createClient()->getTrackingEvents('20190101010101000FOO');

        $this->assertInstanceOf(TrackingResponse::class, $trackingResponse);
        $this->assertInstanceOf(\Traversable::class, $trackingResponse->getIterator());
        $this->assertEquals($preparedAt, $trackingResponse->getPreparedAt()->format('d.m.Y h:i:s'));

        foreach ($trackingResponse as $item) {
            $this->assertInstanceOf(Item::class, $item);
        }
    }

    public function test_exception_thrown_on_soap_fault(): void
    {
        $this->expectExceptionMessage('error');
        $this->expectException(PacketAccessException::class);

        $this->soapMock->will($this->throwException(new \SoapFault('error_code', 'error_message')));

        $this->createClient()->getTrackingEvents('20190101010101000FOO');
    }

    public function test_exception_thrown_on_response_error(): void
    {
        $this->expectExceptionCode(1);
        $this->expectExceptionMessage('service_error');
        $this->expectException(PacketAccessException::class);

        $response = $this->buildClass(TrackingResponse::class, [
            'error' => $this->buildClass(Error::class, [
                'ErrorTypeID' => 1,
                'ErrorName'   => 'service_error',
            ]),
        ]);

        $this->soapMock->willReturn($response);

        $this->createClient()->getTrackingEvents('20190101010101000FOO');
    }

    private function createClient()
    {
        return new class($this->soapClient) extends PacketAccessClient {
            public function __construct($mock)
            {
                parent::__construct('foo', 'bar');

                $this->client = $mock;
            }
        };
    }
}
