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

class DeliveryTime
{
    /**
     * @JMS\Type("int")
     * @JMS\SerializedName("max-days")
     *
     * @var int
     */
    protected $maxDays;

    /**
     * @JMS\Type("int")
     * @JMS\SerializedName("min-days")
     *
     * @var int|null
     */
    protected $minDays;

    /**
     * @return int
     */
    public function getMaxDays(): int
    {
        return $this->maxDays;
    }

    /**
     * @return int
     */
    public function getMinDays(): ?int
    {
        return $this->minDays;
    }
}
