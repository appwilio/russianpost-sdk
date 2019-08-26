<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services;

use Appwilio\RussianPostSDK\Dispatching\Http\ArrayOf;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CalculationRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeFioRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizePhoneRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CheckRecipientRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeAddressRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Fio;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Phone;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Address;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Recipient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\BalanceReponse;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\CalculationResponse;

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
     * @param  NormalizePhoneRequest  $request
     *
     * @return iterable|Phone[]
     */
    public function normalizePhone(NormalizePhoneRequest $request): iterable
    {
        return $this->client->post('/1.0/clean/phone', $request, new ArrayOf(Phone::class));
    }

    /**
     * Нормализация адреса(ов).
     *
     * @param  NormalizeAddressRequest  $request
     *
     * @return iterable|Address[]
     */
    public function normalizeAddress(NormalizeAddressRequest $request): iterable
    {
        return $this->client->post('/1.0/clean/address', $request, new ArrayOf(Address::class));
    }

    /**
     * Нормализация ФИО.
     *
     * @param  NormalizeFioRequest  $request
     *
     * @return iterable|Fio[]
     */
    public function normalizeFio(NormalizeFioRequest $request): iterable
    {
        return $this->client->post('/1.0/clean/physical', $request, new ArrayOf(Fio::class));
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
     * @return iterable|Recipient[]
     */
    public function checkRecipient(CheckRecipientRequest $request): iterable
    {
        return $this->client->post('/1.0/unreliable-recipient', $request, new ArrayOf(Recipient::class));
    }
}
