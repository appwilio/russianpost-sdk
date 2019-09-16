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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Exceptions;

use Appwilio\RussianPostSDK\Dispatching\Entities\Error;
use Appwilio\RussianPostSDK\Dispatching\Contracts\DispatchingException;

class OrderException extends \InvalidArgumentException implements \IteratorAggregate, DispatchingException
{
    /** @var Error[] */
    private $errors;

    public function __construct(array $errors)
    {
        parent::__construct('Не удалось создать заказ.');

        foreach ($errors as $error) {
            $this->errors[] = new Error($error['code'], $error['description'] ?? null);
        }
    }

    /**
     * @return Error[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->errors);
    }
}
