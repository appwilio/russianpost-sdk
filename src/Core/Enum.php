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

namespace Appwilio\RussianPostSDK\Core;

abstract class Enum implements \JsonSerializable
{
    protected static $cache = [];

    protected $value;

    public function __construct($value)
    {
        if ($value instanceof static) {
            $value = $value->getValue();
        }

        if (! \in_array($value, static::toArray(), true)) {
            throw new \UnexpectedValueException("Value '$value' is not part of the enum ".static::class);
        }

        $this->value = $value;
    }

    public static function toArray(): array
    {
        $class = static::class;

        if (! isset(static::$cache[$class])) {
            static::$cache[$class] = (new \ReflectionClass($class))->getConstants();
        }

        return static::$cache[$class];
    }

    public static function __callStatic($name, $arguments)
    {
        $options = static::toArray();

        if (isset($options[$name]) || \array_key_exists($name, $options)) {
            return new static($options[$name]);
        }

        throw new \BadMethodCallException("No static method or enum constant '$name' in class ".static::class);
    }

    public function jsonSerialize()
    {
        return $this->getValue();
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    final public function equals(Enum $other): bool
    {
        return $this === $other || (\get_class($other) === static::class && $this->value === $other->value);
    }

    final public function getValue()
    {
        return $this->value;
    }

    final public function __clone()
    {
        throw new \LogicException('Enums are not cloneable');
    }
}
