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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Responses;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class Lunch implements Arrayable
{
    use DataAware;
    use TimeIntervalAware;

    protected function getBeginValue()
    {
        return $this->get('begin-lunchtime');
    }

    protected function getEndValue()
    {
        return $this->get('end-lunchtime');
    }
}
