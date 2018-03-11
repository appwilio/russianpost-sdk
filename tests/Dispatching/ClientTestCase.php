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
use Appwilio\RussianPostSDK\Dispatching\Client;
use Appwilio\RussianPostSDK\Dispatching\Requests\CalculateRequest;
use Appwilio\RussianPostSDK\Dispatching\Responses\CalculateResponse;
use PHPUnit\Framework\TestCase;

class ClientTestCase extends TestCase
{
    public function testGetCalculate(): void
    {
        $client = $this->createHttpClientMock();
        $category = new MailCategory(MailCategory::ORDINARY);
        $type = new MailType(MailType::EMS);
        $calculate = (new Calculate($category, $type))->to('121351');
        $request = new CalculateRequest($calculate);

        $response = $client->getCalculate($request);

        $this->assertTrue($response instanceof CalculateResponse);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SoapClient| Client
     */
    private function createHttpClientMock()
    {
        $mock = $this->getMockBuilder(Client::class)
            ->setMethods(['getCalculate'])
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('getCalculate')->willReturn(new CalculateResponse());

        /** @var \SoapClient $mock */
        return $mock;
    }
}
