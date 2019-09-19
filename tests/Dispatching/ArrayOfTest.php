<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Tests\Dispatching;

use PHPUnit\Framework\TestCase;
use Appwilio\RussianPostSDK\Dispatching\Http\ArrayOf;

class ArrayOfTest extends TestCase
{
    public function test_it_is_instantiable(): void
    {
        $this->assertInstanceOf(
            ArrayOf::class,
            new ArrayOf(\stdClass::class)
        );
    }

    public function test_can_get_class()
    {
        $this->assertEquals(\stdClass::class, (new ArrayOf(\stdClass::class))->getClass());
    }
}
