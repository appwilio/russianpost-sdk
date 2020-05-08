<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/** @noinspection PhpUnusedPrivateFieldInspection */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

use Appwilio\RussianPostSDK\Core\Enum;

/**
 * Категория вложения.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-entries-type
 *
 * @method static MailEntryType GIFT() Подарок
 * @method static MailEntryType OTHER() Прочее
 * @method static MailEntryType DOCUMENT() Документы
 * @method static MailEntryType GOODS() Товары
 * @method static MailEntryType COMMERCIAL_SAMPLE() Коммерческий образец
 */
final class MailEntryType extends Enum
{
    /** Подарок */
    private const GIFT = 'GIFT';
    /** Прочее */
    private const OTHER = 'OTHER';
    /** Документы */
    private const DOCUMENT = 'DOCUMENT';
    /** Товары */
    private const GOODS = 'SALE_OF_GOODS';
    /** Коммерческий образец */
    private const COMMERCIAL_SAMPLE = 'COMMERCIAL_SAMPLE';
}
