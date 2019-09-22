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

final class CashOnDeliveryEvent
{
    /** @var string */
    private $Number;

    /** @var string */
    private $EventDateTime;

    /** @var string */
    private $EventType;

    /** @var string */
    private $EventName;

    /** @var string */
    private $IndexTo;

    /** @var string */
    private $IndexEvent;

    /** @var string */
    private $SumPaymentForward;

    /** @var string */
    private $CountryEventCode;

    /** @var string */
    private $CountryToCode;

    /**
     * Номер почтового перевода наложенного платежа (Number).
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->Number;
    }

    /**
     * Дата и время операции (EventDateTime).
     *
     * @return \DateTimeImmutable
     */
    public function getPerformedAt(): \DateTimeImmutable
    {
        // Использовать \DATE_RFC3339_EXTENDED можно только в PHP 7.3+
        // @see https://bugs.php.net/bug.php?id=76009
        return \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.???P', $this->EventDateTime);
    }

    /**
     * Код операции с наложенным платежом (EventType).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/event_type
     *
     * @return int
     */
    public function getOperationId(): int
    {
        return (int) $this->EventType;
    }

    /**
     * Название операции (EventName).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/event_type
     *
     * @return string
     */
    public function getOperationName(): string
    {
        return $this->EventName;
    }

    /**
     * @return string
     */
    public function getIndexTo(): string
    {
        return $this->IndexTo;
    }

    /**
     * @return string
     */
    public function getEventPostalCode(): string
    {
        return $this->IndexEvent;
    }

    /**
     * Сумма наложенного платежа в копейках (SumPaymentForward).
     *
     * @return int
     */
    public function getPayment(): int
    {
        return (int) $this->SumPaymentForward;
    }

    /**
     * @return string
     */
    public function getEventCountryCode(): string
    {
        return $this->CountryEventCode;
    }

    /**
     * @return string
     */
    public function getDestinationCountryCode(): string
    {
        return $this->CountryToCode;
    }
}
