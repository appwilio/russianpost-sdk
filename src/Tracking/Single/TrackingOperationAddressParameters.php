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

namespace Appwilio\RussianPostSDK\Tracking\Single;

class TrackingOperationAddressParameters
{
    /** @var TrackingOperationAddress */
    private $DestinationAddress;

    /** @var TrackingOperationAddress */
    private $OperationAddress;

    /** @var TrackingOperationCountry */
    private $MailDirect;

    /** @var TrackingOperationCountry */
    private $CountryOper;

    /** @var TrackingOperationCountry */
    private $CountryFrom;

    /**
     * Адресные данные места назначения (DestinationAddress).
     *
     * @return TrackingOperationAddress
     */
    public function getDestinationAddress(): TrackingOperationAddress
    {
        return $this->DestinationAddress;
    }

    /**
     * Адресные данные места проведения операции (OperationAddress).
     *
     * @return TrackingOperationAddress
     */
    public function getOperationAddress(): TrackingOperationAddress
    {
        return $this->OperationAddress;
    }

    /**
     * Страна места назначения (MailDirect).
     *
     * @return TrackingOperationCountry
     */
    public function getDestinationCountry(): TrackingOperationCountry
    {
        return $this->MailDirect;
    }

    /**
     * Страна приема (CountryFrom).
     *
     * @return TrackingOperationCountry
     */
    public function getDepartureCountry(): TrackingOperationCountry
    {
        return $this->CountryFrom;
    }

    /**
     * Страна проведения операции (CountryOper).
     *
     * @return TrackingOperationCountry
     */
    public function getOperationCountry(): TrackingOperationCountry
    {
        return $this->CountryOper;
    }
}
