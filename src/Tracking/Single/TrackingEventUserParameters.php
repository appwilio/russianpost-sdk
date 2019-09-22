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

final class TrackingEventUserParameters
{
    /** @var Parameter */
    private $SendCtg;

    /** @var string */
    private $Sndr;

    /** @var string */
    private $Rcpn;

    /**
     * Информация о категории отправителя (SendCtg).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/send_ctg
     *
     * @return Parameter
     */
    public function getSenderCategory(): Parameter
    {
        return $this->SendCtg;
    }

    /**
     * Данные отправителя (Sndr).
     *
     * @return string
     */
    public function getSender(): string
    {
        return $this->Sndr;
    }

    /**
     * Данные получателя (Rcpn).
     *
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->Rcpn;
    }
}
