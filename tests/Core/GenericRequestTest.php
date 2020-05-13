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

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Core\GenericRequest;

class GenericRequestTest extends TestCase
{
    private const DATA = ['a' => 1];

    public function test_it_is_instatiable(): void
    {
        $this->assertInstanceOf(GenericRequest::class, new GenericRequest([]));

        $this->assertInstanceOf(GenericRequest::class, GenericRequest::create([]));

        $this->assertInstanceOf(GenericRequest::class, GenericRequest::create(
            (static function () {
                yield from self::DATA;
            })()
        ));
    }

    public function test_serialize(): void
    {
        $this->assertSame(self::DATA, GenericRequest::create(self::DATA)->toArray());
    }
}
