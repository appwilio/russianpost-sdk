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

class PostalOrderEvent
{
    /** @var string */
    public $Number;

    /** @var string */
    public $EventDateTime;

    /** @var string */
    public $EventType;

    /** @var string */
    public $EventName;

    /** @var string */
    public $IndexTo;

    /** @var string */
    public $IndexEvent;

    /** @var string */
    public $SumPaymentForward;

    /** @var string */
    public $CountryEventCode;

    /** @var string */
    public $CountryToCode;
}
