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
use Appwilio\RussianPostSDK\Tracking\Single\Parameter;

class ParameterTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var Parameter $parameter */
        $parameter = $this->buildClass(Parameter::class, [
            'Id'   => ($id = 1),
            'Name' => ($name = 'Прием'),
        ]);

        $this->assertEquals($id, $parameter->getId());
        $this->assertEquals($name, $parameter->getName());
    }
}
