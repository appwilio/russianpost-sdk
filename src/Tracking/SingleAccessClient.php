<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Appwilio\RussianPostSDK\Tracking;

use Appwilio\RussianPostSDK\Tracking\Single\TrackingResponse;
use Appwilio\RussianPostSDK\Tracking\Single\AuthorizationHeader;
use Appwilio\RussianPostSDK\Tracking\Single\PostalOrderEventsForMail;
use Appwilio\RussianPostSDK\Tracking\Exceptions\SingleAccessException;
use Appwilio\RussianPostSDK\Tracking\Single\PostalOrderEventsForMailInput;

class SingleAccessClient
{
    public const LANG_ENG = 'ENG';
    public const LANG_RUS = 'RUS';

    public const HISTORY_OPERATIONS = 0;
    public const HISTORY_NOTIFICATIONS = 1;

    protected const TRACKING_LINK_URL = 'https://www.pochta.ru/tracking';
    protected const TRACKING_WSDL_URL = 'https://tracking.russianpost.ru/rtm34?wsdl';

    protected const XML_NS_HISTORY = 'http://russianpost.org/operationhistory';
    protected const XML_NS_DATA = 'http://russianpost.org/operationhistory/data';

    /** @var AuthorizationHeader */
    protected $auth;

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
            'AuthorizationHeader'              => Single\AuthorizationHeader::class,
            'OperationParameters'              => Single\OperationParameters::class,
            'OperationHistoryData'             => Single\OperationHistoryData::class,
            'OperationHistoryRecord'           => Single\OperationHistoryRecord::class,
            'PostalOrderEventsForMail'         => Single\PostalOrderEventsForMail::class,
            'getOperationHistoryResponse'      => Single\TrackingResponse::class,
            'PostalOrderEventsForMailInput'    => Single\PostalOrderEventsForMailInput::class,
            // Mai – не опечатка
            'PostalOrderEventsForMaiOutput'    => Single\PostalOrderEventsForMailOutput::class,
            'PostalOrderEventsForMailResponse' => Single\CashOnDeliveryResponse::class,
        ],
    ];

    public function __construct(string $login, string $password)
    {
        $this->auth = new AuthorizationHeader($login, $password);
    }

    public function getTrackingUrl(string $number): ?string
    {
        return self::TRACKING_LINK_URL.'#'.$number;
    }

    public function getTrackingEvents(
        string $track,
        string $language = self::LANG_RUS,
        int $type = self::HISTORY_OPERATIONS
    ): TrackingResponse
    {
        $arguments = $this->assembleTrackingHistoryArguments($track, $language, $type);

        try {
            return $this->getClient()->{'getOperationHistory'}($arguments);
        } catch (\SoapFault $e) {
            $detail = get_object_vars($e->{'detail'});

            throw new SingleAccessException(key($detail).': '.current($detail), $e->getCode(), $e);
        }
    }

    public function getCashOnDeliveryEvents(string $code, string $language = self::LANG_RUS)
    {
        $arguments = $this->assembleCashOnDeliveryHistoryArguments($code, $language);

        return $this->getClient()->{'PostalOrderEventsForMail'}($arguments);
    }

    private function assembleTrackingHistoryArguments(string $code, string $language, int $type): array
    {
        return [
            new \SoapVar([
                new \SoapVar([
                    new \SoapVar($code, XSD_STRING, null, null, 'Barcode', self::XML_NS_DATA),
                    new \SoapVar($type, XSD_STRING, null, null, 'MessageType', self::XML_NS_DATA),
                    new \SoapVar($language, XSD_STRING, null, null, 'Language', self::XML_NS_DATA),
                ], SOAP_ENC_OBJECT, null, null, 'OperationHistoryRequest', self::XML_NS_DATA),
                new \SoapVar($this->auth, SOAP_ENCODED, null, null, 'AuthorizationHeader', self::XML_NS_DATA),
            ], SOAP_ENC_OBJECT),
        ];
    }

    private function assembleCashOnDeliveryHistoryArguments(string $code, string $language): array
    {
        $request = new PostalOrderEventsForMail(
            new PostalOrderEventsForMailInput($code, $language),
            $this->auth
        );

        return [
            new \SoapVar($request, SOAP_ENC_OBJECT, null, null, 'PostalOrderEventsForMail', self::XML_NS_HISTORY)
        ];
    }

    protected function getClient(): \SoapClient
    {
        if (! $this->client) {
            $this->client = new \SoapClient(self::TRACKING_WSDL_URL, $this->options);
        }

        return $this->client;
    }
}
