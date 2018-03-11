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

class CalculateResponse
{
    /**
     * @JMS\Type("Appwilio\RussianPostSDK\Dispatching\Responses\Calculate")
     * @JMS\SerializedName("body")
     */
    protected $calculate;

    /**
     * @return Calculate
     */
    public function getCalculate(): Calculate
    {
        return $this->calculate;
    }
}
