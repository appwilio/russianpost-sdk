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

namespace Appwilio\RussianPostSDK\Tracking\Packet;

final class TrackingEvent
{
    /** @var int */
    private $OperTypeID;

    /** @var int */
    private $OperCtgID;

    /** @var string */
    private $OperName;

    /** @var string */
    private $DateOper;

    /** @var string */
    private $IndexOper;

    /**
     * Код операции (OperTypeID).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/operation_codes
     *
     * @return int
     */
    public function getOperationId(): int
    {
        return $this->OperTypeID;
    }

    /**
     * Код атрибута (OperCtgID).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/operation_codes
     *
     * @return int
     */
    public function getAttributeId(): int
    {
        return $this->OperCtgID;
    }

    /**
     * Название операции (OperName).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/operation_codes
     *
     * @return string
     */
    public function getOperationName(): string
    {
        return $this->OperName;
    }

    /**
     * Время (локальное) проведения операции (DateOper).
     *
     * @return \DateTimeImmutable
     */
    public function getPerformedAt(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('d.m.Y H:i:s', $this->DateOper);
    }

    /**
     * Почтовый индекс места проведения операции (IndexOper).
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->IndexOper;
    }
}
