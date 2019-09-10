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

namespace Appwilio\RussianPostSDK\Dispatching;

use Appwilio\RussianPostSDK\Dispatching\Http\ArrayOf;

class Instantiator
{
    /** @var ArrayOf|string $class */
    private $class;

    /** @var bool */
    private $array = false;

    /** @var \ReflectionClass */
    private $reflector;

    public function __construct($class)
    {
        if ($class instanceof ArrayOf) {
            $this->array = true;
            $this->class = $class->getClass();
        } else {
            $this->class = $class;
        }

        $this->reflector = new \ReflectionClass($class);
    }

    /**
     * @param  ArrayOf|string  $class
     * @param  mixed           $data
     *
     * @throws \ReflectionException
     *
     * @return mixed
     */
    public static function instantiate($class, $data)
    {
        if (null === $data) {
            return null;
        }

        return (new self($class))->fill($data);
    }

    public function fill($data)
    {
        if (null === $data) {
            return null;
        }

        if ($this->array) {
            $objects = [];

            foreach ($data as $item) {
                $objects[] = $this->build($this->class, $item);
            }

            return $objects;
        }

        return $this->build($this->class, $data);
    }

    private function build(string $class, array $data)
    {
        $object = new $class;

        $property = $this->reflector->getProperty('data');

        $property->setAccessible(true);

        $property->setValue($object, $data);

        return $object;
    }
}
