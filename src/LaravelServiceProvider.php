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

use Psr\Log\LoggerAwareInterface;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;
use Appwilio\RussianPostSDK\Tracking\SingleAccessClient;
use Appwilio\RussianPostSDK\Dispatching\DispatchingClient;

class LaravelServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(SingleAccessClient::class, function (Container $app) {
            $config = $app['config']['services.russianpost.tracking'];

            return $this->setLoggerToClient(
                new SingleAccessClient($config['login'], $config['password'])
            );
        });

        $this->app->singleton(PacketAccessClient::class, function (Container $app) {
            $config = $app['config']['services.russianpost.tracking'];

            return $this->setLoggerToClient(
                new PacketAccessClient($config['login'], $config['password'])
            );
        });

        $this->app->singleton(DispatchingClient::class, function (Container $app) {
            $config = $app['config']['services.russianpost.dispatching'];

            $client = new DispatchingClient(
                $config['login'], $config['password'], $config['token'], new GuzzleClient()
            );

            return $this->setLoggerToClient($client);
        });
    }

    public function provides(): array
    {
        return [
            DispatchingClient::class,
            SingleAccessClient::class,
            PacketAccessClient::class,
        ];
    }

    private function setLoggerToClient(LoggerAwareInterface $client)
    {
        if ($this->app->bound('appwilio.russianpost.logger')) {
            $client->setLogger($this->app['appwilio.russianpost.logger']);
        }

        return $client;
    }
}
