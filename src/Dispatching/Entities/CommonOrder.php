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

namespace Appwilio\RussianPostSDK\Dispatching\Entities;

trait CommonOrder
{
    public function dimensions(int $height, int $width, int $length)
    {
        $this->data['dimension'] = \compact('height', 'width', 'length');

        return $this;
    }

    public function fragile(bool $value = true)
    {
        $this->data['fragile'] = $value;

        return $this;
    }

    public function transport(string $value)
    {
        $this->data['transport-type'] = $value;

        return $this;
    }

    public function withCompletenessChecking(bool $value = true)
    {
        $this->data['completeness-checking'] = $value;

        return $this;
    }

    public function withElectronicNotice(bool $value = true)
    {
        $this->data['with-electronic-notice'] = $value;

        return $this;
    }

    public function withInventory(bool $value = true)
    {
        $this->data['inventory'] = $value;

        return $this;
    }

    public function withRegisteredNotice(bool $value = true)
    {
        $this->data['with-order-of-notice'] = $value;

        return $this;
    }

    public function withSimpleNotice(bool $value = true)
    {
        $this->data['with-simple-notice'] = $value;

        return $this;
    }

    public function withSmsNotice(bool $value = true)
    {
        $this->data['sms-notice-recipient'] = $value;

        return $this;
    }

    public function withVsd(bool $value = true)
    {
        $this->data['vsd'] = $value;

        return $this;
    }

    public function viaCourier(bool $value = true)
    {
        $this->data['courier'] = $value;

        return $this;
    }
}
