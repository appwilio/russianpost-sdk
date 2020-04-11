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

namespace Appwilio\RussianPostSDK\Tests\Dispatching\Endpoints\Services\Entities;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\CheckedRecipient;

class CheckedRecipientTest extends TestCase
{
    public function test_can_get_data(): void
    {
        /** @var CheckedRecipient $instance */
        $instance = Instantiator::instantiate(CheckedRecipient::class, [
            'raw-address'   => ($rawAddress = '7'),
            'raw-telephone' => ($rawPhone = '901'),
            'raw-full-name' => ($rawName = '2345678'),
            'unreliability' => ($result = CheckedRecipient::RELIABLE),
        ]);

        $this->assertEquals($rawAddress, $instance->getAddress());
        $this->assertEquals($rawName, $instance->getFullName());
        $this->assertEquals($rawPhone, $instance->getPhone());
        $this->assertEquals($result, $instance->getResult());
        $this->assertEquals(true, $instance->isReliable());
        $this->assertEquals(false, $instance->isFraud());
    }
}
