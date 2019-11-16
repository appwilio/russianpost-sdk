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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedFio;

class Recipient implements Arrayable
{
    use DataAware;

    public static function fromNormalizedFio(NormalizedFio $normalizedFio)
    {
        $data = [
            'surname' => $normalizedFio->getLastName(),
            'given-name' => $normalizedFio->getFirstName(),
            'middle-name' => $normalizedFio->getMiddleName(),
        ];

        $raw = \trim(\implode(' ', $data));

        if ($raw) {
            $data['recipient-name'] = $raw;
        }

        return Instantiator::instantiate(self::class, $data);
    }

    public function __construct(string $rawName)
    {
        $this->data['recipient-name'] = $rawName;
    }

    public function setFirstName(string $firstName)
    {
        $this->data['given-name'] = $firstName;
    }

    public function setMiddleName(string $middleName)
    {
        $this->data['middle-name'] = $middleName;
    }

    public function setLastName(string $lastName)
    {
        $this->data['surname'] = $lastName;
    }

    public function setPhoneNumber(string $phoneNumber)
    {
        $this->data['tel-address'] = $phoneNumber;
    }
}
