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

class AuthorizationHeader
{
    /** @var string */
    public $login;

    /** @var string */
    public $password;

    /** @var string */
    public $mustUnderstand;

    public function __construct(?string $login = null, ?string $password = null)
    {
        $this->login = $login;
        $this->password = $password;

        $this->mustUnderstand = '1';
    }
}
