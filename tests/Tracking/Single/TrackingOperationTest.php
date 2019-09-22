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

namespace Appwilio\RussianPostSDK\Tests\Tracking\Single;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperation;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationParameters;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationItemParameters;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationUserParameters;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationAddressParameters;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationFinanceParameters;

class TrackingOperationTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingOperation $operation */
        $operation = $this->buildClass(TrackingOperation::class, [
            'AddressParameters'   => $this->buildClass(TrackingOperationAddressParameters::class),
            'FinanceParameters'   => $this->buildClass(TrackingOperationFinanceParameters::class),
            'ItemParameters'      => $this->buildClass(TrackingOperationItemParameters::class),
            'OperationParameters' => $this->buildClass(TrackingOperationParameters::class),
            'UserParameters'      => $this->buildClass(TrackingOperationUserParameters::class),
        ]);

        $this->assertInstanceOf(TrackingOperationItemParameters::class, $operation->getItemParameters());
        $this->assertInstanceOf(TrackingOperationUserParameters::class, $operation->getUserParameters());
        $this->assertInstanceOf(TrackingOperationParameters::class, $operation->getOperationParameters());
        $this->assertInstanceOf(TrackingOperationAddressParameters::class, $operation->getAddressParameters());
        $this->assertInstanceOf(TrackingOperationFinanceParameters::class, $operation->getFinanceParameters());
    }
}
