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

final class TrackingEvent
{
    /** @var TrackingEventAddressParameters */
    private $AddressParameters;

    /** @var TrackingEventFinanceParameters */
    private $FinanceParameters;

    /** @var TrackingEventItemParameters */
    private $ItemParameters;

    /** @var TrackingEventOperationParameters */
    private $OperationParameters;

    /** @var TrackingEventUserParameters */
    private $UserParameters;

    /**
     * Адресные данные операции (AddressParameters).
     *
     * @return TrackingEventAddressParameters
     */
    public function getAddressParameters(): TrackingEventAddressParameters
    {
        return $this->AddressParameters;
    }

    /**
     * Финансовые данные операции (FinanceParameters).
     *
     * @return TrackingEventFinanceParameters
     */
    public function getFinanceParameters(): TrackingEventFinanceParameters
    {
        return $this->FinanceParameters;
    }

    /**
     * Данные о почтовом отправлении (ItemParameters).
     *
     * @return TrackingEventItemParameters
     */
    public function getItemParameters(): TrackingEventItemParameters
    {
        return $this->ItemParameters;
    }

    /**
     * Параметры операции (OperationParameters).
     *
     * @return TrackingEventOperationParameters
     */
    public function getOperationParameters(): TrackingEventOperationParameters
    {
        return $this->OperationParameters;
    }

    /**
     * Данные субъектов, связанных с операцией (UserParameters).
     *
     * @return TrackingEventUserParameters
     */
    public function getUserParameters(): TrackingEventUserParameters
    {
        return $this->UserParameters;
    }
}
