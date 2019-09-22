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

namespace Appwilio\RussianPostSDK\Tests\Tracking;

use Appwilio\RussianPostSDK\Tests\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Builder\InvocationMocker;

trait MockSoap
{
    /** @var \SoapClient|MockObject */
    protected $soapClient;

    /** @var InvocationMocker */
    protected $soapMock;

    public function setUp(): void
    {
        $this->soapClient = $this->mockSoap();

        $this->soapMock = $this->soapClient->method('__soapCall');
    }

    private function mockSoap()
    {
        /** @var TestCase $this */
        return $this->getMockBuilder(\SoapClient::class)
            ->setMethods(['__soapCall'])
            ->disableOriginalConstructor()
            ->getMock();
    }
}
