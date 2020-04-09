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
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\Balance;

class BalanceTest extends TestCase
{
    public function test_can_get_data(): void
    {
        /** @var Balance $instance */
        $instance = Instantiator::instantiate(Balance::class, [
            'work-with-balance' => true,
            'balance'           => $value = 123.0,
            'balance-date'      => $date = '2020-04-08',
        ]);

        $this->assertEquals($value, $instance->getValue());
        $this->assertEquals(\DateTimeImmutable::createFromFormat('Y-m-d', $date), $instance->getDate());
    }

    public function test_exception_thrown_if_work_without_balance(): void
    {
        /** @var Balance $balance */
        $balance = Instantiator::instantiate(Balance::class, [
            'error-message' => $message = 'test'
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($message);

        $balance->getValue();
    }
}
