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

class PostalOrderEventsForMail
{
    /** @var AuthorizationHeader */
    public $AuthorizationHeader;

    /** @var PostalOrderEventsForMailInput */
    public $PostalOrderEventsForMailInput;

    public function __construct(
        PostalOrderEventsForMailInput $PostalOrderEventsForMailInput,
        AuthorizationHeader $AuthorizationHeader
    ) {
        $this->PostalOrderEventsForMailInput = $PostalOrderEventsForMailInput;
        $this->AuthorizationHeader = $AuthorizationHeader;
    }
}
