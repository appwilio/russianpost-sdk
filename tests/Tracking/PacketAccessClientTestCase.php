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

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;
use Appwilio\RussianPostSDK\Tracking\Packet\TicketResponse;
use Appwilio\RussianPostSDK\Tracking\Packet\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Exceptions\PacketAccessException;

class PacketAccessClientTestCase extends TestCase
{
    public function test_client_is_instantiable(): void
    {
        Assert::assertInstanceOf(
            PacketAccessClient::class,
            $this->getClient()
        );
    }

    public function test_can_get_ticket(): void
    {
        Assert::assertInstanceOf(
            TicketResponse::class,
            $this->getClient()->getTicket(['29500098765432'])
        );
    }

    public function test_cannot_get_ticket_if_tracks_number_limit_exceeded(): void
    {
        $this->expectException(PacketAccessException::class);

        $source = (static function () {
            foreach (range(1, 3001) as $item) {
                yield sprintf('2950009876%04d', $item);
            }
        })();

        $this->getClient()->getTicket($source);
    }

    public function test_can_get_tracking_events(): void
    {
        Assert::assertInstanceOf(
            TrackingResponse::class,
            $this->getClient()->getTrackingEvents('20170801000000foo')
        );
    }

    private function getClient()
    {
        $mock = $this->createSoapClientMock();

        return new class($mock) extends PacketAccessClient {
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
                'getTicket'           => new TicketResponse(),
                'getResponseByTicket' => new TrackingResponse(),
            ])[$method];
        });

        /** @var \SoapClient $mock */
        return $mock;
    }
}
