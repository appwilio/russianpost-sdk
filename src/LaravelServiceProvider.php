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

namespace Appwilio\RussianPostSDK;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;
use Appwilio\RussianPostSDK\Tracking\SingleAccessClient;

class LaravelServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(SingleAccessClient::class, static function (Container $app) {
            $config = $app['config']['services.russianpost.tracking'];

            return new SingleAccessClient($config['login'], $config['password']);
        });

        $this->app->singleton(PacketAccessClient::class, static function (Container $app) {
            $config = $app['config']['services.russianpost.tracking'];

            return new PacketAccessClient($config['login'], $config['password']);
        });
    }

    public function provides(): array
    {
        return [
            SingleAccessClient::class,
            PacketAccessClient::class,
        ];
    }
}
