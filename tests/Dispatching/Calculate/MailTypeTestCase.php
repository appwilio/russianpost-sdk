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

use Appwilio\RussianPostSDK\Dispatching\Calculate\MailType;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\MailTypeException;
use PHPUnit\Framework\TestCase;

class MailTypeTestCase extends TestCase
{
    public function testBase(): void
    {
        $typeName = MailType::EMS;
        $type = new MailType($typeName);

        $this->assertEquals($type->getName(), $typeName);
    }

    public function testValidException(): void
    {
        $this->expectException(MailTypeException::class);
        new MailType('NOT_VALID_TYPE');
    }
}
