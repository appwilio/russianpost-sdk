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
use Appwilio\RussianPostSDK\Tracking\Packet\Error;
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;
use Appwilio\RussianPostSDK\Tracking\Packet\TicketResponse;
use Appwilio\RussianPostSDK\Tracking\Packet\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Exceptions\PacketAccessException;

class PacketAccessClientTestCase extends TestCase
{
    public function test_client_is_instantiable(): void
    {
        $this->assertInstanceOf(
            PacketAccessClient::class,
            $this->createClient()
        );
    }

    public function test_can_get_ticket(): void
    {
        ($soap = $this->mockSoap())->expects($this->once())
            ->method('__soapCall')
            ->with('getTicket', $this->isType('array'), ...\array_fill(0, 3, $this->isNull()))
            ->willReturn(new TicketResponse());

        $this->assertInstanceOf(
            TicketResponse::class,
            $this->createClient($soap)->getTicket(['RA644000001RU'])
        );
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
        ($soap = $this->mockSoap())->expects($this->once())
            ->method('__soapCall')
            ->with('getResponseByTicket', $this->isType('array'), ...\array_fill(0, 3, $this->isNull()))
            ->willReturn(new TrackingResponse());

        $this->assertInstanceOf(
            TrackingResponse::class,
            $this->createClient($soap)->getTrackingEvents('20190101010101000FOO')
        );
    }

    public function test_exception_thrown_on_soap_fault(): void
    {
        $this->expectExceptionMessage('error');
        $this->expectException(PacketAccessException::class);

        ($soap = $this->mockSoap())->expects($this->once())
            ->method('__soapCall')
            ->will($this->throwException(new \SoapFault('error_code', 'error_message')));

        $this->createClient($soap)->getTrackingEvents('20190101010101000FOO');
    }

    public function test_exception_thrown_on_response_error(): void
    {
        $this->expectExceptionCode(1);
        $this->expectExceptionMessage('service_error');
        $this->expectException(PacketAccessException::class);

        $error = $this->createMock(Error::class);
        $error->method('getCode')->willReturn(1);
        $error->method('getMessage')->willReturn('service_error');

        $response = $this->createMock(TrackingResponse::class);
        $response->method('hasError')->willReturn(true);
        $response->method('getError')->willReturn($error);

        ($soap = $this->mockSoap())->expects($this->once())
            ->method('__soapCall')
            ->willReturn($response);

        $this->createClient($soap)->getTrackingEvents('20190101010101000FOO');
    }

    private function createClient($soap = null)
    {
        return new class($soap ?? $this->mockSoap()) extends PacketAccessClient {
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
