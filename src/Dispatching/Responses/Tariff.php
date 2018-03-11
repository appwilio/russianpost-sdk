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

namespace Appwilio\RussianPostSDK\Dispatching\Responses;

use JMS\Serializer\Annotation AS JMS;

class Tariff
{
    /**
     * @JMS\Type("float")
     * @JMS\SerializedName("rate")
     *
     * @var float
     */
    protected $price;

    /**
     * @JMS\Type("float")
     * @JMS\SerializedName("vat")
     *
     * @var float
     */
    protected $vat;

    /**
     * Тариф без НДС, руб
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price/100;
    }

    /**
     * НДС, руб
     *
     * @return float
     */
    public function getVat(): float
    {
        return $this->vat/100;
    }
}
