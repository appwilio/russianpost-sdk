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

namespace Appwilio\RussianPostSDK\Tests\Dispatching\Endpoints\Services;

use Psr\Log\NullLogger;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client as HttpClient;
use PHPUnit\Framework\MockObject\MockObject;
use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailType;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Http\Authentication;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Services;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\Balance;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\Calculation;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedFio;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedPhone;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\CheckedRecipient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedAddress;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CalculationRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeFioRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CheckRecipientRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizePhoneRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Exceptions\CalculationException;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeAddressRequest;
use function GuzzleHttp\json_encode as guzzle_json_encode;

class ServicesTest extends TestCase
{
    public function test_can_get_balance(): void
    {
        $endpoint = new Services($this->createClient(['balance' => 100000]));

        $this->assertInstanceOf(Balance::class, $endpoint->getBalance());
    }

    public function test_check_recipient(): void
    {
        $endpoint = new Services($this->createClient([
            [
                'raw-address'   => $address = 'Москва',
                'raw-telephone' => ($phone = '8 901 234-56-78'),
                'raw-full-name' => ($name = 'Иванов Иван Иванович'),
            ],
        ]));

        $result = $endpoint->checkRecipient(CheckRecipientRequest::one($address, $name, $phone));

        $this->assertIsArray($result);
        $this->assertInstanceOf(CheckedRecipient::class, $result[0]);
    }

    public function test_calculate(): void
    {
        $response = [
            'payment-method' => 'cash',
            'total-rate'     => 800,
            'total-vat'      => 200,
        ];

        $endpoint = new Services($this->createClient($response));

        $request = CalculationRequest::create($index = '123456', 1000)
            ->dimensions(100, 100, 100)
            ->fragile()
            ->viaCourier()
            ->withFitting()
            ->withInventory()
            ->withSmsNotice()
            ->withSimpleNotice()
            ->withRegisteredNotice()
            ->withElectronicNotice()
            ->withContentChecking()
            ->withCompletenessChecking()
            ->ofMailType(MailType::EMS());

        $this->assertEquals($index, $request->toArray()['index-to']);
        $this->assertEquals($index, (clone $request)->ofMailType(MailType::ECOM())->toArray()['delivery-point-index']);

        $this->assertInstanceOf(Calculation::class, $endpoint->calculate($request));

        $this->expectException(CalculationException::class);

        $endpoint = new Services($this->createClient(\array_merge($response, [
            'total-rate' => 0,
            'total-vat' => 0,
        ])));

        $endpoint->calculate($request)->getTotalRate();
    }

    public function test_can_normalize_fio(): void
    {
        $endpoint = new Services($this->createClient([
            ['id' => '123', 'original-fio' => $fio = 'Иванов Иван Иванович'],
        ]));

        $result = $endpoint->normalizeFio(NormalizeFioRequest::one($fio));

        $this->assertIsArray($result);
        $this->assertInstanceOf(NormalizedFio::class, $result[0]);
    }

    public function test_can_normalize_phone(): void
    {
        $endpoint = new Services($this->createClient([
            ['id' => '123', 'original-phone' => $phone = '8 901 234-56-78'],
        ]));

        $result = $endpoint->normalizePhone(NormalizePhoneRequest::one($phone));

        $this->assertIsArray($result);
        $this->assertInstanceOf(NormalizedPhone::class, $result[0]);
    }

    public function test_can_normalize_address(): void
    {
        $endpoint = new Services($this->createClient([
            [
                'id'               => '123',
                'original-address' => $address = 'Москва',
            ],
        ]));

        $result = $endpoint->normalizeAddress(NormalizeAddressRequest::one($address));

        $this->assertIsArray($result);
        $this->assertInstanceOf(NormalizedAddress::class, $result[0]);
    }

    private function createClient(array $body): ApiClient
    {
        return new ApiClient(
            new Authentication('foo', 'bar', 'baz'),
            $this->createHttpClient($body),
            new NullLogger()
        );
    }

    /**
     * @param  mixed  $body
     *
     * @return HttpClient|MockObject
     */
    private function createHttpClient($body)
    {
        $httpClient = $this->createMock(HttpClient::class);

        $httpClient->method('send')->willReturnCallback(static function () use ($body) {
            return new Response(200, ['Content-Type' => 'application/json'], guzzle_json_encode($body));
        });

        return $httpClient;
    }
}
