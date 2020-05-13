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
 * Тип печати уведомления.
 *
 * @method static PrintFormType ONE_SIDED()
 * @method static PrintFormType TWO_SIDED()
 */
final class PrintFormType extends Enum
{
    private const ONE_SIDED = 'ONE_SIDED';
    private const TWO_SIDED = 'TWO_SIDED';
}
