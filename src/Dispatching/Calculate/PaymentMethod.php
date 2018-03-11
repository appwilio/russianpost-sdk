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

use Appwilio\RussianPostSDK\Dispatching\Exceptions\PaymentMethodException;


class PaymentMethod
{
    /**
     * Payments methods @see https://otpravka.pochta.ru/specification#/enums-payment-methods
     */
    public const CASHLESS = 'CASHLESS';
    public const STAMP = 'STAMP';
    public const FRANKING = 'FRANKING';

    /**
     * @var array
     */
    private $allowedMethods = [
        self::CASHLESS,
        self::STAMP,
        self::FRANKING,
    ];

    /**
     * @var string
     */
    private $name;

    /**
     * PaymentMethod constructor.
     *
     * @param string $name
     *
     * @throws \Appwilio\RussianPostSDK\Dispatching\Exceptions\PaymentMethodException
     */
    public function __construct(string $name)
    {
        if (!$this->isMethodValid($name)) {
            throw PaymentMethodException::incorrectMethod();
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
    private function isMethodValid(string $name): bool
    {
        return in_array($name, $this->allowedMethods);
    }
}
