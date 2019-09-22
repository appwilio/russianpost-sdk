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

final class TrackingEventOperationParameters
{
    /** @var Parameter */
    private $OperType;

    /** @var Parameter */
    private $OperAttr;

    /** @var string */
    private $OperDate;

    /**
     * Код операции (OperType→Id).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/operation_codes
     *
     * @return int
     */
    public function getOperationId(): int
    {
        return $this->OperType->getId();
    }

    /**
     * Название операции (OperType→Name).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/operation_codes
     *
     * @return string
     */
    public function getOperationName(): string
    {
        return $this->OperType->getName();
    }

    /**
     * Код атрибута операции (OperAttr→Id).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/operation_codes
     *
     * @return int
     */
    public function getAttributeId(): int
    {
        return $this->OperAttr->getId();
    }

    /**
     * Название атрибута операции (OperAttr→Name).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/operation_codes
     *
     * @return string
     */
    public function getAttributeName(): string
    {
        return $this->OperAttr->getName();
    }

    /**
     * Время проведения операции (OperDate).
     *
     * @return \DateTimeImmutable
     */
    public function getPerformedAt(): \DateTimeImmutable
    {
        // Использовать \DATE_RFC3339_EXTENDED можно только в PHP 7.3+
        // @see https://bugs.php.net/bug.php?id=76009
        return \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.???P', $this->OperDate);
    }
}
