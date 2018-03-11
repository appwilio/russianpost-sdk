<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Exceptions;

class CalculateException extends \Exception
{
    public static function incorrectIndex(): self
    {
        return new self('Некорректно указан индекс, индекс должен состоять только из цифр');
    }
}
