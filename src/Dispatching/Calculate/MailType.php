<?php
/**
 * This file is part of russianpost-sdk package.
 *
 * @author Anton Kartsev <anton@alarm.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Calculate;

use Appwilio\RussianPostSDK\Dispatching\Exceptions\MailTypeException;


class MailType
{
    /**
     * Mail types @see https://otpravka.pochta.ru/specification#/enums-base-mail-type
     */
    public const POSTAL_PARCEL = 'POSTAL_PARCEL';
    public const ONLINE_PARCEL = 'ONLINE_PARCEL';
    public const ONLINE_COURIER = 'ONLINE_COURIER';
    public const EMS = 'EMS';
    public const EMS_OPTIMAL = 'EMS_OPTIMAL';
    public const LETTER = 'LETTER';
    public const BANDEROL = 'BANDEROL';
    public const BUSINESS_COURIER = 'BUSINESS_COURIER';
    public const BUSINESS_COURIER_ES = 'BUSINESS_COURIER_ES';
    public const PARCEL_CLASS_1 = 'PARCEL_CLASS_1';
    public const COMBINED = 'COMBINED';

    /**
     * @var array
     */
    private $allowedTypes = [
        self::POSTAL_PARCEL,
        self::ONLINE_PARCEL,
        self::ONLINE_COURIER,
        self::EMS,
        self::EMS_OPTIMAL,
        self::LETTER,
        self::BANDEROL,
        self::BUSINESS_COURIER,
        self::BUSINESS_COURIER_ES,
        self::PARCEL_CLASS_1,
        self::COMBINED,
    ];

    /**
     * @var string
     */
    private $name;

    /**
     * MailType constructor.
     *
     * @param string $name
     *
     * @throws \Appwilio\RussianPostSDK\Dispatching\Exceptions\MailTypeException
     */
    public function __construct(string $name)
    {
        if (!$this->isCategoryValid($name)) {
            throw MailTypeException::incorrectType();
        }

        $this->setType($name);
    }

    /**
     * @param string $name
     *
     * @return self
     */
    private function setType(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    private function isCategoryValid(string $name): bool
    {
        return in_array($name, $this->allowedTypes);
    }
}
