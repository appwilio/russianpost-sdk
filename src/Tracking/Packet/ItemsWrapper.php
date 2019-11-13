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

namespace Appwilio\RussianPostSDK\Tracking\Packet;

final class ItemsWrapper
{
    /** @var Item[]|Item */
    private $Item;

    /** @var string */
    private $DatePreparation;

    /**
     * @return Item[]
     */
    public function getItems()
    {
        if ($this->Item instanceof Item) {
            $this->Item = [$this->Item];
        }

        return $this->Item;
    }

    public function getPreparedAt(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat(
            'd.m.Y H:i:s',
            $this->DatePreparation,
            new \DateTimeZone('Europe/Moscow')
        );
    }
}
