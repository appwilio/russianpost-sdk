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

use Appwilio\RussianPostSDK\Tracking\Single\Authentication;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Single\AuthorizationHeader;
use Appwilio\RussianPostSDK\Tracking\Single\PostalOrderEventsForMail;
use Appwilio\RussianPostSDK\Tracking\Exceptions\SingleAccessException;
use Appwilio\RussianPostSDK\Tracking\Single\PostalOrderEventsForMailInput;

class SingleAccessClient
{
    public const LANG_ENG = 'ENG';
    public const LANG_RUS = 'RUS';

    public const HISTORY_OPERATIONS    = 0;
    public const HISTORY_NOTIFICATIONS = 1;

    protected const LINK_URL = 'https://www.pochta.ru/tracking';
    protected const WSDL_URL = 'https://tracking.pochta.ru/tracking-web-static/rtm34_wsdl.xml';

    protected const XML_NS_DATA        = 'http://russianpost.org/operationhistory/data';
    protected const XML_NS_COD_HISTORY = 'http://www.russianpost.org/RTM/DataExchangeESPP/Data';

    /** @var Authentication */
    protected $authentication;

    /** @var \SoapClient */
    protected $client;

    protected $options = [
        'soap_version' => SOAP_1_2,
        'trace'        => 1,
        'classmap'     => [
            'Address'                          => Single\Address::class,
            'Country'                          => Single\Country::class,
            'Rtm02Parameter'                   => Single\Parameter::class,
            'UserParameters'                   => Single\UserParameters::class,
            'ItemParameters'                   => Single\ItemParameters::class,
            'PostalOrderEvent'                 => Single\PostalOrderEvent::class,
            'AddressParameters'                => Single\AddressParameters::class,
            'FinanceParameters'                => Single\FinanceParameters::class,
            'AuthorizationHeader'              => Single\Authentication::class,
            'OperationParameters'              => Single\OperationParameters::class,
            'OperationHistoryData'             => Single\OperationHistoryData::class,
            'OperationHistoryRecord'           => Single\OperationHistoryRecord::class,
            'getOperationHistoryResponse'      => Single\TrackingResponse::class,
            'PostalOrderEventsForMailInput'    => Single\PostalOrderEventsForMailInput::class,
            // Mai – не опечатка
            'PostalOrderEventsForMaiOutput'    => Single\PostalOrderEventsForMailOutput::class,
            'PostalOrderEventsForMailResponse' => Single\CashOnDeliveryResponse::class,
        ],
    ];

    public function __construct(string $login, string $password)
    {
        $this->authentication = new Authentication($login, $password);
    }

    public function getTrackingUrl(string $number): ?string
    {
        return self::LINK_URL.'#'.$number;
    }

    public function getTrackingEvents(
        string $track,
        string $language = self::LANG_RUS,
        int $type = self::HISTORY_OPERATIONS
    ): TrackingResponse {
        $arguments = $this->assembleTrackingRequestArguments($track, $language, $type);

        try {
            return $this->getClient()->__soapCall('getOperationHistory', [$arguments]);
        } catch (\SoapFault $e) {
            if (\property_exists($e, 'detail')) {
                $detail = \get_object_vars($e->{'detail'});

                throw new SingleAccessException(\key($detail).': '.\current($detail), $e->getCode(), $e);
            }

            throw new SingleAccessException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getCashOnDeliveryEvents(string $track, string $language = self::LANG_RUS)
    {
        $arguments = $this->assembleCashOnDeliveryRequestArguments($track, $language);

        return $this->getClient()->__soapCall('PostalOrderEventsForMail', [$arguments]);
    }

    private function assembleTrackingRequestArguments(string $track, string $language, int $type): \SoapVar
    {
        return new \SoapVar([
            new \SoapVar([
                new \SoapVar($track, \XSD_STRING, '', '', 'Barcode', self::XML_NS_DATA),
                new \SoapVar($type, \XSD_STRING, '', '', 'MessageType', self::XML_NS_DATA),
                new \SoapVar($language, \XSD_STRING, '', '', 'Language', self::XML_NS_DATA),
            ], \SOAP_ENC_OBJECT, '', '', 'OperationHistoryRequest', self::XML_NS_DATA),
            new \SoapVar($this->authentication, \SOAP_ENCODED, '', '', 'AuthorizationHeader', self::XML_NS_DATA),
        ], \SOAP_ENC_OBJECT);
    }

    private function assembleCashOnDeliveryRequestArguments(string $code, string $language): \SoapVar
    {
        $input = new PostalOrderEventsForMailInput($code, $language);

        return new \SoapVar([
            new \SoapVar($input, \SOAP_ENC_OBJECT, '', '', 'PostalOrderEventsForMailInput', self::XML_NS_COD_HISTORY),
            new \SoapVar($this->authentication, \SOAP_ENCODED, '', '', 'AuthorizationHeader', self::XML_NS_DATA),
        ], \SOAP_ENC_OBJECT);
    }

    protected function getClient(): \SoapClient
    {
        if (! $this->client) {
            $this->client = new \SoapClient(self::WSDL_URL, $this->options);
        }

        return $this->client;
    }
}
