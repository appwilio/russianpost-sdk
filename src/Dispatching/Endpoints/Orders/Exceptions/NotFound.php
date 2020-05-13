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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Exceptions;

use Appwilio\RussianPostSDK\Dispatching\Contracts\DispatchingException;

final class NotFound extends \InvalidArgumentException implements DispatchingException
{
    public function __construct(string $id)
    {
        parent::__construct("Заказ #{$id} не найден.");
    }
}
