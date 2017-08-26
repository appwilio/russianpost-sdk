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

namespace Tracking;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;
use Appwilio\RussianPostSDK\Tracking\Packet\TicketResponse;
use Appwilio\RussianPostSDK\Tracking\Packet\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Exceptions\PacketAccessException;

class PacketAccessClientTestCase extends TestCase
{
    public function test_client_is_instantiable()
    {
        Assert::assertInstanceOf(
            PacketAccessClient::class,
            $this->getClient()
        );
    }

    public function test_can_get_ticket()
    {
        Assert::assertInstanceOf(
            TicketResponse::class,
            $this->getClient()->getTicket(['29500098765432'])
        );
    }

    public function test_cannot_get_ticket_if_tracks_number_limit_exceeded()
    {
        $this->expectException(PacketAccessException::class);

        $source = (function () {
            foreach (range(1, 3001) as $item) {
                yield sprintf('2950009876%04d', $item);
            }
        })();

        $this->getClient()->getTicket($source);
    }

    public function test_can_get_tracking_events()
    {
        Assert::assertInstanceOf(
            TrackingResponse::class,
            $this->getClient()->getTrackingEvents('20170801000000foo')
        );
    }

    private function getClient()
    {
        $mock = $this->createSoapClientMock();

        return new class($mock) extends PacketAccessClient{
            public function __construct($mock)
            {
                parent::__construct('foo', 'bar');

                $this->client = $mock;
            }
        };
    }

    private function createSoapClientMock()
    {
        $mock = $this->getMockBuilder(\SoapClient::class)
            ->setMethods(['getTicket', 'getResponseByTicket'])
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('getTicket')->willReturn(new TicketResponse());
        $mock->method('getResponseByTicket')->willReturn(new TrackingResponse());

        /** @var \SoapClient $mock */
        return $mock;
    }
}
