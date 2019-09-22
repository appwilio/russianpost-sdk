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

namespace Appwilio\RussianPostSDK\Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function buildClass(string $class, array $properties = [])
    {
        $object = new $class();

        $reflector = new \ReflectionClass($object);

        foreach ($properties as $name => $value) {
            $property = $reflector->getProperty($name);

            $property->setAccessible(true);

            $property->setValue($object, $value);
        }

        return $object;
    }
}
