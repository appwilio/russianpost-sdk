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

class TrackingOperationParameters
{
    /** @var Parameter */
    private $OperType;

    /** @var Parameter */
    private $OperAttr;

    /** @var string */
    private $OperDate;

    /**
     * Информация об операции (OperType).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/operation_codes
     *
     * @return Parameter
     */
    public function getOperation(): Parameter
    {
        return $this->OperType;
    }

    /**
     * Атрибут операции (OperAttr).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/operation_codes
     *
     * @return Parameter
     */
    public function getAttribute(): Parameter
    {
        return $this->OperAttr;
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
