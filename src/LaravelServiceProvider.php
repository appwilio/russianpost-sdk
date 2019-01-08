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
use Illuminate\Contracts\Foundation\Application;
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;
use Appwilio\RussianPostSDK\Tracking\SingleAccessClient;
use Appwilio\RussianPostSDK\Dispatching\DispatchingClient;

class LaravelServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(SingleAccessClient::class, function (Application $app) {
            $config = $app['config']['services.russianpost.tracking'];

            return new SingleAccessClient($config['login'], $config['password']);
        });

        $this->app->singleton(PacketAccessClient::class, function (Application $app) {
            $config = $app['config']['services.russianpost.tracking'];

            return new PacketAccessClient($config['login'], $config['password']);
        });

        $this->app->singleton(DispatchingClient::class, function (Application $app) {
            $config = $app['config']['services.russianpost.dispatching'];

            return new DispatchingClient($config['login'], $config['password'], $config['token']);
        });
    }

    public function provides()
    {
        return [
            SingleAccessClient::class, PacketAccessClient::class, DispatchingClient::class
        ];
    }
}
