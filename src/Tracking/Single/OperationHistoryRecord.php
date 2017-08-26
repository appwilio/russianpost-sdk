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

class OperationHistoryRecord
{
    /** @var AddressParameters */
    public $AddressParameters;

    /** @var FinanceParameters */
    public $FinanceParameters;

    /** @var ItemParameters */
    public $ItemParameters;

    /** @var OperationParameters */
    public $OperationParameters;

    /** @var UserParameters */
    public $UserParameters;

    public function getAddressParameters(): AddressParameters
    {
        return $this->AddressParameters;
    }

    public function getFinanceParameters(): FinanceParameters
    {
        return $this->FinanceParameters;
    }

    public function getItemParameters(): ItemParameters
    {
        return $this->ItemParameters;
    }

    public function getOperationParameters(): OperationParameters
    {
        return $this->OperationParameters;
    }

    public function getUserParameters(): UserParameters
    {
        return $this->UserParameters;
    }
}
