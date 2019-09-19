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

namespace Appwilio\RussianPostSDK\Dispatching\Exceptions;

use Appwilio\RussianPostSDK\Dispatching\Contracts\DispatchingException;

class UnknownEndpoint extends \InvalidArgumentException implements DispatchingException
{
    public function __construct(string $value)
    {
        parent::__construct("Unknown endpoint {$value}.");
    }
}
