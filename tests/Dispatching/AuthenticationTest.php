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

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Appwilio\RussianPostSDK\Dispatching\Http\Authentication;

class AuthenticationTest extends TestCase
{
    public function test_it_is_instantiable(): void
    {
        $this->assertInstanceOf(
            Authentication::class,
            new Authentication('foo', 'bar', '123')
        );
    }

    public function test_it_can_autenticate_request(): void
    {
        $request = (new Authentication('foo', 'bar', '123'))
            ->authenticate(new Request('GET', 'https://example.com'));

        $this->assertEquals('AccessToken 123', $request->getHeaderLine('Authorization'));
        $this->assertEquals('Basic '.\base64_encode('foo:bar'), $request->getHeaderLine('X-User-Authorization'));
    }
}
