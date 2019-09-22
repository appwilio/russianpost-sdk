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

final class TicketResponse
{
    use ErrorAware;

    /** @var Error|null */
    private $error;

    /** @var string */
    private $value;

    public function getId(): string
    {
        return $this->value;
    }
}
