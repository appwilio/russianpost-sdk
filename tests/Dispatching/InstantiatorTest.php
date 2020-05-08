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

namespace Appwilio\RussianPostSDK\Tests\Dispatching;

use Appwilio\RussianPostSDK\Core\ArrayOf;
use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;

class InstantiatorTest extends TestCase
{
    public function test_it_is_instantiable(): void
    {
        $this->assertInstanceOf(Instantiator::class, new Instantiator('stdClass'));
        $this->assertInstanceOf(Instantiator::class, new Instantiator(new ArrayOf('stdClass')));
    }

    public function test_it_is_nullable_if_no_data(): void
    {
        $this->assertNull(Instantiator::instantiate('stdClass', null));
        $this->assertNull((new Instantiator('stdClass'))->fill(null));

        $this->assertNull(Instantiator::instantiate(new ArrayOf('stdClass'), null));
    }

    public function test_exception_thrown_if_class_has_no_data_property(): void
    {
        $this->expectException(\ReflectionException::class);

        $this->assertNull(Instantiator::instantiate('stdClass', ['foo' => 'bar']));
    }

    public function test_it_is_instantiate_classes_via_array(): void
    {
        $instance = Instantiator::instantiate(RecipientClass::class, ['foo' => 'bar', 'baz' => '10']);

        $this->assertInstanceOf(RecipientClass::class, $instance);

        $this->assertEquals('bar', $instance->getKey('foo'));
        $this->assertEquals('10', $instance->getKey('baz'));
        $this->assertEquals(10, $instance->getKey('baz', 'int'));

        $this->assertCount(
            2,
            Instantiator::instantiate(new ArrayOf(RecipientClass::class), [['foo' => 'bar'], ['qux' => 'baz']])
        );
    }

    public function test_it_is_instantiate_class_from_other_class(): void
    {
        $class = Instantiator::instantiateFrom(RecipientClass::class, new SenderClass());
        $this->assertInstanceOf(RecipientClass::class, $class);
        $this->assertArrayHasKey('foo', $class->toArray());
        $this->assertArrayHasKey('qux', $class->toArray());

        $classWithoutFoo = Instantiator::instantiateFrom(RecipientClass::class, new SenderClass(), ['foo']);
        $this->assertInstanceOf(RecipientClass::class, $classWithoutFoo);
        $this->assertArrayHasKey('qux', $classWithoutFoo->toArray());
        $this->assertArrayNotHasKey('foo', $classWithoutFoo->toArray());
    }
}

class RecipientClass
{
    use DataAware;

    public function getKey(string $key, ?string $type = null)
    {
        return $this->get($key, $type);
    }

    public function toArray(): array
    {
        return $this->data;
    }
}

class SenderClass
{
    protected $data = [
        'foo' => 'bar',
        'qux' => 'baz',
    ];
}
