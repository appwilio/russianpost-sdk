<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * @author Anton Kartsev <anton@alarm.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Dispatching;

use Appwilio\RussianPostSDK\Dispatching\Calculate\Calculate;
use Appwilio\RussianPostSDK\Dispatching\Calculate\MailCategory;
use Appwilio\RussianPostSDK\Dispatching\Calculate\MailType;
use Appwilio\RussianPostSDK\Dispatching\Requests\CalculateRequest;
use PHPUnit\Framework\TestCase;

class CalculateRequestTestCase extends TestCase
{

    public function testGetBodyArray(): void
    {
        $request = new CalculateRequest($this->getCalculate());
        $array = $request->getBodyArray();
        $this->assertArrayHasKey('mail-category', $array);
        $this->assertArrayHasKey('mail-type', $array);
        $this->assertArrayHasKey('mass', $array);
        $this->assertArrayHasKey('with-order-of-notice', $array);
        $this->assertArrayHasKey('with-simple-notice', $array);
    }

    public function testGetMethod(): void
    {
        $request = new CalculateRequest($this->getCalculate());
        $this->assertEquals($request->getMethod(), CalculateRequest::METHOD);
    }

    public function testGetUrl(): void
    {
        $request = new CalculateRequest($this->getCalculate());
        $this->assertEquals($request->getUrl(), CalculateRequest::ENDPOINT);
    }

    /**
     * @return \Appwilio\RussianPostSDK\Dispatching\Calculate\Calculate
     */
    private function getCalculate(): Calculate
    {
        return (new Calculate(
            new MailCategory(MailCategory::SIMPLE),
            new MailType(MailType::POSTAL_PARCEL)
        ));
    }

}
