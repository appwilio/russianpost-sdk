<?php /** @noinspection PhpUnusedPrivateFieldInspection */

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Tests\Core;

use Appwilio\RussianPostSDK\Core\Enum;
use Appwilio\RussianPostSDK\Tests\TestCase;

class EnumTest extends TestCase
{
    public function test_can_get_value(): void
    {
        $item = new EnumFixture($value = 'BAR');

        $this->assertEquals($value, $item->getValue());
    }

    public function test_can_not_create_with_invalid_value(): void
    {
        $this->expectException(\UnexpectedValueException::class);

        new EnumFixture('XYZ');
    }

    public function test_can_not_get_invalid_value(): void
    {
        $this->expectException(\BadMethodCallException::class);

        EnumFixture::NONEXISTENT();
    }

    public function test_can_not_clone(): void
    {
        $this->expectException(\LogicException::class);

        $item = new EnumFixture('FOO');

        /** @noinspection PhpExpressionResultUnusedInspection */
        clone $item;
    }

    /**
     * @dataProvider toStringProvider
     *
     * @param $expected
     * @param $item
     */
    public function test_can_get_string_value($expected, $item): void
    {
        $this->assertSame($expected, (string) $item);
    }

    public function toStringProvider(): \Generator
    {
        yield [EnumValues::BAR, new EnumFixture(EnumValues::BAR)];
        yield [EnumValues::FOO, new EnumFixture(EnumValues::FOO)];
        yield [(string) EnumValues::ONE, new EnumFixture(EnumValues::ONE)];
    }
}

/**
 * @method static BAR()
 * @method static FOO()
 * @method static ONE()
 * @method static NONEXISTENT()
 */
class EnumFixture extends Enum
{
    private const BAR = EnumValues::BAR;
    private const FOO = EnumValues::FOO;
    private const ONE = EnumValues::ONE;
}

class EnumValues
{
    public const BAR = 'BAR';
    public const FOO = 'FOO';
    public const ONE = 1;
    public const NONEXISTENT = 'NONEXISTENT';
}
