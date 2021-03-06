<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Exceptions;

use Appwilio\RussianPostSDK\Dispatching\Contracts\DispatchingException;

final class BadRequest extends \RuntimeException implements DispatchingException
{
    //
}
