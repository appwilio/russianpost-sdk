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

namespace Appwilio\RussianPostSDK\Tracking\Single;

class TrackingOperation
{
    /** @var TrackingOperationAddressParameters */
    private $AddressParameters;

    /** @var TrackingOperationFinanceParameters */
    private $FinanceParameters;

    /** @var TrackingOperationItemParameters */
    private $ItemParameters;

    /** @var TrackingOperationParameters */
    private $OperationParameters;

    /** @var TrackingOperationUserParameters */
    private $UserParameters;

    /**
     * Адресные данные операции (AddressParameters).
     *
     * @return TrackingOperationAddressParameters
     */
    public function getAddressParameters(): TrackingOperationAddressParameters
    {
        return $this->AddressParameters;
    }

    /**
     * Финансовые данные операции (FinanceParameters).
     *
     * @return TrackingOperationFinanceParameters
     */
    public function getFinanceParameters(): TrackingOperationFinanceParameters
    {
        return $this->FinanceParameters;
    }

    /**
     * Данные о почтовом отправлении (ItemParameters).
     *
     * @return TrackingOperationItemParameters
     */
    public function getItemParameters(): TrackingOperationItemParameters
    {
        return $this->ItemParameters;
    }

    /**
     * Параметры операции (OperationParameters).
     *
     * @return TrackingOperationParameters
     */
    public function getOperationParameters(): TrackingOperationParameters
    {
        return $this->OperationParameters;
    }

    /**
     * Данные субъектов, связанных с операцией (UserParameters).
     *
     * @return TrackingOperationUserParameters
     */
    public function getUserParameters(): TrackingOperationUserParameters
    {
        return $this->UserParameters;
    }
}
