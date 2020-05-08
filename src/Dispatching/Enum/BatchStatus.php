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
 * Статус партии.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-batch-status
 *
 * @method static BatchStatus CREATED() Партия создана
 * @method static BatchStatus FROZEN() Партия в процессе приема, редактирование запрещено
 * @method static BatchStatus ACCEPTED() Партия принята в отделении связи
 * @method static BatchStatus SENT() По заказам в партии существуют данные в сервисе трекинга
 * @method static BatchStatus ARCHIVED() Партия находится в архиве
 */
final class BatchStatus extends Enum
{
    /** Партия создана */
    private const CREATED = 'CREATED';
    /** Партия в процессе приема, редактирование запрещено */
    private const FROZEN = 'FROZEN';
    /** Партия принята в отделении связи */
    private const ACCEPTED = 'ACCEPTED';
    /** По заказам в партии существуют данные в сервисе трекинга */
    private const SENT = 'SENT';
    /** Партия находится в архиве */
    private const ARCHIVED = 'ARCHIVED';
}
