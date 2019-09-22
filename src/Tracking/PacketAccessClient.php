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

namespace Appwilio\RussianPostSDK\Tracking;

use Psr\Log\NullLogger;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerAwareInterface;
use Appwilio\RussianPostSDK\Tracking\Packet\TicketResponse;
use Appwilio\RussianPostSDK\Tracking\Packet\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Exceptions\PacketAccessException;

class PacketAccessClient implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public const LANG_ENG = 'ENG';
    public const LANG_RUS = 'RUS';

    public const HISTORY_OPERATIONS    = 0;
    public const HISTORY_NOTIFICATIONS = 1;

    public const ERROR_NOT_READY = 6;
    public const ERROR_INTERNAL  = 16;

    protected const WSDL_URL = 'https://tracking.pochta.ru/tracking-web-static/fc_wsdl.xml';

    /** @var string */
    protected $login;

    /** @var string */
    protected $password;

    /** @var \SoapClient */
    protected $client;

    protected $options = [
        'soap_version' => \SOAP_1_1,
        'trace'        => 1,
        'classmap'     => [
            // в wsdl-файле некоторые элементы называются не так, как в документации
            'item'                   => Packet\Item::class,          // Item → item
            'error'                  => Packet\Error::class,         // корневая ошибка
            'Error'                  => Packet\Error::class,         // ошибка конкретного РПО
            'file'                   => Packet\ItemsWrapper::class,  // value → file
            'operation'              => Packet\TrackingEvent::class, // Operation → operation

            'ticketResponse'         => TicketResponse::class,
            'answerByTicketResponse' => TrackingResponse::class,
        ],
    ];

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;

        $this->logger = new NullLogger();
    }

    public function getTicket(iterable $tracks, string $language = self::LANG_RUS): TicketResponse
    {
        if (\is_array($tracks)) {
            $tracks = new \ArrayIterator($tracks);
        }

        if (\iterator_count($tracks) > 3000) {
            throw PacketAccessException::trackNumberLimitExceeded();
        }

        return $this->callSoapMethod(
            'getTicket',
            $this->assembleTicketRequestArguments($tracks, $language)
        );
    }

    public function getTrackingEvents(string $ticket): TrackingResponse
    {
        return $this->callSoapMethod(
            'getResponseByTicket',
            $this->assembleTrackingRequestArgument($ticket)
        );
    }

    protected function getClient(): \SoapClient
    {
        return $this->client ?? ($this->client = new \SoapClient(self::WSDL_URL, $this->options));
    }

    private function callSoapMethod(string $method, \SoapVar $arguments)
    {
        try {
            $response = $this->getClient()->__soapCall($method, [$arguments]);

            if ($response->hasError()) {
                throw new PacketAccessException($response->getError()->getMessage(), $response->getError()->getCode());
            }

            return $response;
        } catch (\SoapFault $e) {
            throw new PacketAccessException($e->getMessage(), $e->getCode(), $e);
        } finally {
            $this->logger->info("pochta.ru Packet Tracking request: {$this->getClient()->__getLastRequest()}");
            $this->logger->info("pochta.ru Packet Tracking response: {$this->getClient()->__getLastResponse()}");
        }
    }

    private function assembleTicketRequestArguments(iterable $tracks, string $language): \SoapVar
    {
        $items = new \ArrayObject();

        foreach ($tracks as $track) {
            $items->append(new \SoapVar("<Item Barcode=\"{$track}\" />", \XSD_ANYXML));
        }

        return new \SoapVar([
            new \SoapVar($items, \SOAP_ENC_OBJECT, '', '', 'request'),
            new \SoapVar($this->login, \XSD_STRING, '', '', 'login'),
            new \SoapVar($this->password, \XSD_STRING, '', '', 'password'),
            new \SoapVar($language, \XSD_STRING, '', '', 'language'),
        ], \SOAP_ENC_OBJECT);
    }

    private function assembleTrackingRequestArgument(string $ticket): \SoapVar
    {
        return new \SoapVar([
            new \SoapVar($ticket, \XSD_STRING, '', '', 'ticket'),
            new \SoapVar($this->login, \XSD_STRING, '', '', 'login'),
            new \SoapVar($this->password, \XSD_STRING, '', '', 'password'),
        ], \SOAP_ENC_OBJECT);
    }
}
