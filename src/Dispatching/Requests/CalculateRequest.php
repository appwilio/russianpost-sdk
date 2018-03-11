<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

use Appwilio\RussianPostSDK\Dispatching\Calculate\CalculateInterface;

class CalculateRequest implements RequestInterface
{
    public const ENDPOINT = 'https://otpravka-api.pochta.ru/1.0/tariff';
    public const METHOD = 'POST';

    /**
     * @var CalculateInterface
     */
    private $calculate;

    /**
     * CalculateRequest constructor.
     *
     * @param \Appwilio\RussianPostSDK\Dispatching\Calculate\CalculateInterface $calculate
     */
    public function __construct(CalculateInterface $calculate)
    {
        $this->calculate = $calculate;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return self::ENDPOINT;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return self::METHOD;
    }

    /**
     * @return array
     */
    public function getBodyArray(): array
    {
        return array_filter([
            'courier'              => $this->calculate->isCourier(),
            'declared-value'       => $this->calculate->getDeclaredValue(),
            'dimension'            => $this->getDimension(),
            'fragile'              => $this->calculate->isFragile(),
            'index-from'           => $this->calculate->getFrom(),
            'index-to'             => $this->calculate->getTo(),
            'mail-category'        => $this->calculate->getCategory()->getName(),
            'mail-type'            => $this->calculate->getType()->getName(),
            'mass'                 => $this->calculate->getWeight(),
            'payment-method'       => $this->calculate->getPayment() ? $this->calculate->getPayment()->getName() : null,
            'with-order-of-notice' => $this->calculate->getWithOrderOfNotice(),
            'with-simple-notice'   => $this->calculate->getWithSimpleNotice(),
        ], function ($value) {
            if (is_null($value)) {
                return false;
            }

            return true;
        });
    }


    /**
     * @return array|null
     */
    private function getDimension()
    {
        $dimension = array_filter([
            'height' => $this->calculate->getHeight(),
            'length' => $this->calculate->getLength(),
            'width'  => $this->calculate->getWidth(),
        ]);

        return !empty($dimension) ? $dimension : null;
    }
}
