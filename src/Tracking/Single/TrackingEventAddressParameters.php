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

final class TrackingEventAddressParameters
{
    /** @var TrackingEventAddress */
    private $DestinationAddress;

    /** @var TrackingEventAddress */
    private $OperationAddress;

    /** @var TrackingEventCountry */
    private $MailDirect;

    /** @var TrackingEventCountry */
    private $CountryOper;

    /** @var TrackingEventCountry */
    private $CountryFrom;

    /**
     * Адресные данные места назначения (DestinationAddress).
     *
     * @return TrackingEventAddress
     */
    public function getDestinationAddress(): TrackingEventAddress
    {
        return $this->DestinationAddress;
    }

    /**
     * Адресные данные места проведения операции (OperationAddress).
     *
     * @return TrackingEventAddress
     */
    public function getOperationAddress(): TrackingEventAddress
    {
        return $this->OperationAddress;
    }

    /**
     * Страна места назначения (MailDirect).
     *
     * @return TrackingEventCountry
     */
    public function getDestinationCountry(): TrackingEventCountry
    {
        return $this->MailDirect;
    }

    /**
     * Страна приема (CountryFrom).
     *
     * @return TrackingEventCountry
     */
    public function getDepartureCountry(): TrackingEventCountry
    {
        return $this->CountryFrom;
    }

    /**
     * Страна проведения операции (CountryOper).
     *
     * @return TrackingEventCountry
     */
    public function getOperationCountry(): TrackingEventCountry
    {
        return $this->CountryOper;
    }
}
