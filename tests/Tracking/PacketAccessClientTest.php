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

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Tracking\Packet\Item;
use Appwilio\RussianPostSDK\Tracking\Packet\Error;
use Appwilio\RussianPostSDK\Tracking\Packet\Wrapper;
use Appwilio\RussianPostSDK\Tracking\Packet\Operation;
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;
use Appwilio\RussianPostSDK\Tracking\Packet\TicketResponse;
use Appwilio\RussianPostSDK\Tracking\Packet\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Exceptions\PacketAccessException;

class PacketAccessClientTest extends TestCase
{
    public function test_client_is_instantiable(): void
    {
        $this->assertInstanceOf(PacketAccessClient::class, $this->createClient());
    }

    public function test_can_get_ticket(): void
    {
        ($soap = $this->mockSoap())
            ->method('__soapCall')
            ->with('getTicket', $this->isType('array'))
            ->willReturn($this->buildClass(TicketResponse::class, [
                'value' => ($ticketId = '20190101010101000FOO'),
            ]));

        $ticket = $this->createClient($soap)->getTicket(['RA644000001RU']);

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
        $operId = 1;
        $operCat = 1;
        $operName = 'Приём';
        $operDate = '02.01.2019 01:02:03';
        $postalCode = '644008';
        $barcode = 'RA644000001RU';
        $preparedAt = '01.01.2019 01:02:03';

        $response = $this->buildClass(TrackingResponse::class, [
            'value' => $this->buildClass(Wrapper::class, [
                'DatePreparation' => $preparedAt,
                'Item'            => $this->buildClass(Item::class, [
                    'Barcode'   => $barcode,
                    'Operation' => [$this->buildClass(Operation::class, [
                        'OperTypeID' => $operId,
                        'OperCtgID'  => $operCat,
                        'OperName'   => $operName,
                        'DateOper'   => $operDate,
                        'IndexOper'  => $postalCode,
                    ])],
                ]),
            ]),
        ]);

        ($soap = $this->mockSoap())
            ->method('__soapCall')
            ->with('getResponseByTicket', $this->isType('array'))
            ->willReturn($response);

        $trackingResponse = $this->createClient($soap)->getTrackingEvents('20190101010101000FOO');

        $this->assertInstanceOf(TrackingResponse::class, $trackingResponse);
        $this->assertInstanceOf(\Traversable::class, $trackingResponse->getIterator());
        $this->assertEquals($preparedAt, $trackingResponse->getPreparedAt()->format('d.m.Y h:i:s'));

        foreach ($trackingResponse as $item) {
            $this->assertInstanceOf(Item::class, $item);
        }

        $item = $trackingResponse->getItems()[0];

        $this->assertEquals($barcode, $item->getBarcode());
        $this->assertInstanceOf(\Traversable::class, $item->getIterator());

        foreach ($item as $operation) {
            $this->assertInstanceOf(Operation::class, $operation);
        }

        $operation = $item->getOperations()[0];

        $this->assertEquals($postalCode, $operation->getPostalCode());
        $this->assertEquals($operId, $operation->getOperationId());
        $this->assertEquals($operCat, $operation->getAttributeId());
        $this->assertEquals($operName, $operation->getOperationName());
        $this->assertEquals($operDate, $operation->getPerformedAt()->format('d.m.Y h:i:s'));
    }

    public function test_exception_thrown_on_soap_fault(): void
    {
        $this->expectExceptionMessage('error');
        $this->expectException(PacketAccessException::class);

        ($soap = $this->mockSoap())
            ->method('__soapCall')
            ->will($this->throwException(new \SoapFault('error_code', 'error_message')));

        $this->createClient($soap)->getTrackingEvents('20190101010101000FOO');
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
            ])
        ]);

        ($soap = $this->mockSoap())
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
