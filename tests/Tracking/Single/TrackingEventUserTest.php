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

namespace Appwilio\RussianPostSDK\Tests\Tracking\Single;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Tracking\Single\Parameter;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventUserParameters;

class TrackingEventUserTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingEventUserParameters $parameters */
        $parameters = $this->buildClass(TrackingEventUserParameters::class, [
            'SendCtg' => $this->buildClass(Parameter::class),
            'Sndr'    => ($sender = 'ИВАНОВ А. Н.'),
            'Rcpn'    => ($resipient = 'ПЕТРОВ И. К.'),
        ]);

        $this->assertInstanceOf(Parameter::class, $parameters->getSenderCategory());
        $this->assertEquals($sender, $parameters->getSender());
        $this->assertEquals($resipient, $parameters->getRecipient());
    }
}
