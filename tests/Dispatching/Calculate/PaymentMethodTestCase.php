<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * @author Anton Kartsev <anton@alarm.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Dispatching\Calculate;

use Appwilio\RussianPostSDK\Dispatching\Calculate\PaymentMethod;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\PaymentMethodException;
use PHPUnit\Framework\TestCase;

class PaymentMethodTestCase extends TestCase
{
    public function testBase(): void
    {
        $methodName = PaymentMethod::CASHLESS;
        $method = new PaymentMethod($methodName);

        $this->assertEquals($method->getName(), $methodName);
    }

    public function testValidException(): void
    {
        $this->expectException(PaymentMethodException::class);
        new PaymentMethod('NOT_VALID_METHOD');
    }
}
