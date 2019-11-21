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
        return Instantiator::instantiate(self::class, [
            'surname'     => $normalizedFio->getLastName(),
            'given-name'  => $normalizedFio->getFirstName(),
            'middle-name' => $normalizedFio->getMiddleName(),
        ]);
    }

    public static function create(?string $fullName = null): self
    {
        return new self($fullName);
    }

    public function __construct(?string $fullName = null)
    {
        if ($fullName) {
            $this->data['recipient-name'] = $fullName;
        }
    }

    public function firstName(string $firstName)
    {
        $this->data['given-name'] = $firstName;

        return $this;
    }

    public function middleName(string $middleName)
    {
        $this->data['middle-name'] = $middleName;

        return $this;
    }

    public function lastName(string $lastName)
    {
        $this->data['surname'] = $lastName;

        return $this;
    }

    public function phoneNumber(string $phoneNumber)
    {
        $this->data['tel-address'] = $phoneNumber;

        return $this;
    }

    public function toArray(): array
    {
        if (empty($this->data['recipient-name'])) {
            $fullName = \trim(\implode(' ', [
                $this->data['surname'],
                $this->data['given-name'],
                $this->data['middle-name'],
            ]));

            if ($fullName) {
                $this->data['recipient-name'] = $fullName;
            }
        }

        return $this->data;
    }
}
