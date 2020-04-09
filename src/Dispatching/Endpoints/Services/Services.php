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
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\Balance;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\Calculation;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\CheckedRecipient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedFio;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedPhone;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedAddress;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CalculationRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeFioRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizePhoneRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CheckRecipientRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Exceptions\CalculationException;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeAddressRequest;

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
     * @return iterable|NormalizedPhone[]
     */
    public function normalizePhone(NormalizePhoneRequest $request): iterable
    {
        return $this->client->post('/1.0/clean/phone', $request, new ArrayOf(NormalizedPhone::class));
    }

    /**
     * Нормализация ФИО.
     *
     * @link https://otpravka.pochta.ru/specification#/nogroup-normalization_fio
     *
     * @param  NormalizeFioRequest  $request
     *
     * @return iterable|NormalizedFio[]
     */
    public function normalizeFio(NormalizeFioRequest $request): iterable
    {
        return $this->client->post('/1.0/clean/physical', $request, new ArrayOf(NormalizedFio::class));
    }

    /**
     * Нормализация адреса(ов).
     *
     * @link https://otpravka.pochta.ru/specification#/nogroup-normalization_adress
     *
     * @param  NormalizeAddressRequest  $request
     *
     * @return iterable|NormalizedAddress[]
     */
    public function normalizeAddress(NormalizeAddressRequest $request): iterable
    {
        return $this->client->post('/1.0/clean/address', $request, new ArrayOf(NormalizedAddress::class));
    }

    /**
     * Расчёт стоимости доставки.
     *
     * @link https://otpravka.pochta.ru/specification#/nogroup-rate_calculate
     *
     * @param  CalculationRequest  $request
     *
     * @return Calculation
     */
    public function calculate(CalculationRequest $request): Calculation
    {
        /** @var Calculation $calculation */
        $calculation = $this->client->post('/1.0/tariff', $request, Calculation::class);

        if ($calculation->getTotalRate()->getAmountWithVAT() === 0) {
            throw CalculationException::becauseZeroTotalRate();
        }

        return $calculation;
    }

    /**
     * Получение баланса расчётного счёта.
     *
     * @link https://otpravka.pochta.ru/specification#/nogroup-counterpart_balance
     *
     * @return Balance
     */
    public function getBalance(): Balance
    {
        return $this->client->get('/1.0/counterpart/balance', null, Balance::class);
    }

    /**
     * Проверка благонадёжности получателя(ей).
     *
     * @link https://otpravka.pochta.ru/specification#/nogroup-unreliable_recipient
     *
     * @param  CheckRecipientRequest  $request
     *
     * @return iterable|CheckedRecipient[]
     */
    public function checkRecipient(CheckRecipientRequest $request): iterable
    {
        return $this->client->post('/1.0/unreliable-recipient', $request, new ArrayOf(CheckedRecipient::class));
    }
}
