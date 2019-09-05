<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * @link https://otpravka.pochta.ru/specification#/nogroup-normalization_phone
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
     * @link https://otpravka.pochta.ru/specification#/nogroup-normalization_adress
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
     * @link https://otpravka.pochta.ru/specification#/nogroup-normalization_fio
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
     * @link https://otpravka.pochta.ru/specification#/nogroup-rate_calculate
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
     * Получение баланса расчётного счёта.
     *
     * @link https://otpravka.pochta.ru/specification#/nogroup-counterpart_balance
     *
     * @return BalanceReponse
     */
    public function getBalance(): BalanceReponse
    {
        return $this->client->get('/1.0/counterpart/balance', null, BalanceReponse::class);
    }

    /**
     * Проверка благонадёжности получателя(ей).
     *
     * @link https://otpravka.pochta.ru/specification#/nogroup-unreliable_recipient
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
