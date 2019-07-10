<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services;

use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Address;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Fio;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Phone;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Recipient;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CalculationRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeFioRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizePhoneRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CheckRecipientRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeAddressRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\BalanceReponse;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\CalculationResponse;
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

    /**
     * Нормализация телефона(ов).
     *
     * @param NormalizePhoneRequest $request
     *
     * @return iterable|NormalizePhoneResponse|Phone[]
     */
    public function normalizePhone(NormalizePhoneRequest $request): NormalizePhoneResponse
    {
        return $this->client->post('/1.0/clean/phone', $request, NormalizePhoneResponse::class);
    }

    /**
     * Нормализация адреса(ов).
     *
     * @param NormalizeAddressRequest $request
     *
     * @return iterable|NormalizeAddressResponse|Address[]
     */
    public function normalizeAddress(NormalizeAddressRequest $request): NormalizeAddressResponse
    {
        return $this->client->post('/1.0/clean/address', $request, NormalizeAddressResponse::class);
    }

    /**
     * Нормализация ФИО.
     *
     * @param NormalizeFioRequest $request
     *
     * @return iterable|NormalizeFioResponse|Fio[]
     */
    public function normalizeFio(NormalizeFioRequest $request): NormalizeFioResponse
    {
        return $this->client->post('/1.0/clean/physical', $request, NormalizeFioResponse::class);
    }

    /**
     * Расчёт стоимости доставки.
     *
     * @param  CalculationRequest  $request
     *
     * @return CalculationResponse
     */
    public function calculate(CalculationRequest $request): CalculationResponse
    {
        return $this->client->post('/1.0/tariff', $request, CalculationResponse::class);
    }

    /**
     * @return BalanceReponse
     */
    public function getBalance(): BalanceReponse
    {
        return $this->client->get('/1.0/counterpart/balance', null, BalanceReponse::class);
    }

    /**
     * Проверка благонадёжности получателя(ей).
     *
     * @param  CheckRecipientRequest  $request
     *
     * @return iterable|CheckRecipientResponse|Recipient[]
     */
    public function checkRecipient(CheckRecipientRequest $request): CheckRecipientResponse
    {
        return $this->client->post('/1.0/unreliable-recipient', $request, CheckRecipientResponse::class);
    }
}
