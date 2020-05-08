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
 * Тип объекта в паспорте ОПС
 *
 * @see https://otpravka.pochta.ru/specification#/enums-passport-object-types
 *
 * @method static OpsType OPS() ОПС
 * @method static OpsType PVZ() ПВЗ
 * @method static OpsType APS() Почтоматы
 * @method static OpsType ALL() Все объекты
 */
final class OpsType extends Enum
{
    /** ОПС */
    private const OPS = 'OPS';
    /** ПВЗ */
    private const PVZ = 'PVZ';
    /** Почтоматы */
    private const APS = 'APS';
    /** Все объекты */
    private const ALL = 'ALL';
}
