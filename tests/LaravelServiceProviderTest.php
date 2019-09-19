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

use PHPUnit\Framework\TestCase;
use Appwilio\RussianPostSDK\LaravelServiceProvider;
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;
use Appwilio\RussianPostSDK\Tracking\SingleAccessClient;
use Appwilio\RussianPostSDK\Dispatching\DispatchingClient;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;

class LaravelServiceProviderTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|ApplicationContract */
    private $app;

    /** @var LaravelServiceProvider */
    private $provider;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app = $this->createMock(ApplicationContract::class);

        $this->provider = new LaravelServiceProvider($this->app);
    }

    public function test_register(): void
    {
        $bindings = [];

        $this->app->expects($this->exactly(3))
            ->method('singleton')
            ->willReturnCallback(static function ($abstract) use (&$bindings) {
                $bindings[] = $abstract;
            });

        $this->provider->register();

        $this->assertEqualsCanonicalizing(
            [SingleAccessClient::class, PacketAccessClient::class, DispatchingClient::class],
            $bindings
        );
    }

    public function test_provides(): void
    {
        $this->assertEqualsCanonicalizing($this->provider->provides(), [
            DispatchingClient::class,
            PacketAccessClient::class,
            SingleAccessClient::class,
        ]);
    }
}
