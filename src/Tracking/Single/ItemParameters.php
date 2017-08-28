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

class ItemParameters
{
    /** @var Parameter */
    public $MailRank;

    /** @var string */
    public $PostMark;

    /** @var string */
    public $MailType;

    /** @var string */
    public $MailCtg;

    /** @var string */
    public $Barcode;

    /** @var string */
    public $ValidRuType;

    /** @var string */
    public $ValidEnType;

    /** @var string */
    public $ComplexItemName;

    /** @var string */
    public $Mass;
}
