<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services;

use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CalculateRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeFioRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizePhoneRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CheckRecipientRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeAddressRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\BalanceReponse;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\CalculateResponse;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\NormalizeFioResponse;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\NormalizePhoneResponse;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\CheckRecipientResponse;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\NormalizeAddressResponse;

final class Services
{
    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function normalizePhone(NormalizePhoneRequest $request): NormalizePhoneResponse
    {
        return $this->client->post('/clean/phone', $request, NormalizePhoneResponse::class);
    }

    public function normalizeAddress(NormalizeAddressRequest $request): NormalizeAddressResponse
    {
        return $this->client->post('/clean/address', $request, NormalizeAddressResponse::class);
    }

    public function normalizeFio(NormalizeFioRequest $request): NormalizeFioResponse
    {
        return $this->client->post('/clean/physical', $request, NormalizeFioResponse::class);
    }

    public function calculate(CalculateRequest $request): CalculateResponse
    {
        return $this->client->post('/tariff', $request, CalculateResponse::class);
    }

    public function getBalance(): BalanceReponse
    {
        return $this->client->get('/counterpart/balance', null, BalanceReponse::class);
    }

    public function checkRecipient(CheckRecipientRequest $request): CheckRecipientResponse
    {
        return $this->client->post('/unreliable-recipient', $request, CheckRecipientResponse::class);
    }
}
