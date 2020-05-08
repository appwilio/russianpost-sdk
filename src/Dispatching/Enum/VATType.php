<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/** @noinspection PhpUnusedPrivateFieldInspection */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

use Appwilio\RussianPostSDK\Core\Enum;

/**
 * Ставка НДС.
 *
 * @method static VATType VAT_NO()
 * @method static VATType VAT_0()
 * @method static VATType VAT_10()
 * @method static VATType VAT_20()
 * @method static VATType VAT_110()
 * @method static VATType VAT_120()
 */
final class VATType extends Enum
{
    private const VAT_NO = -1;
    private const VAT_0 = 0;
    private const VAT_10 = 10;
    private const VAT_20 = 20;
    private const VAT_110 = 110;
    private const VAT_120 = 120;
}
